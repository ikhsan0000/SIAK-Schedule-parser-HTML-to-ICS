const buttonPush = document.querySelector("#push");
const sendPush = document.querySelector("#send-push");

const publicKey = `BAbYNfFpKahAqgknAeLfokoC2g2lwYBz9mraqhr4JN--zwFYC2jYZ6Fq7v0LFEvGOLyDan-aYr9gZBSdgdlN1Cg`
// const privateKey = 'S9CO1QHicojnUp5t5cJfyWyiHc_xYnKKvdM3d5zQB6U'

//source https://github.com/GoogleChromeLabs/web-push-codelab/blob/master/app/scripts/main.js
function urlB64ToUint8Array(base64String) 
{
    const padding = '='.repeat((4 - base64String.length % 4) % 4);
    const base64 = (base64String + padding)
      .replace(/\-/g, '+')
      .replace(/_/g, '/');
  
    const rawData = window.atob(base64);
    const outputArray = new Uint8Array(rawData.length);
  
    for (let i = 0; i < rawData.length; ++i) {
      outputArray[i] = rawData.charCodeAt(i);
    }
    return outputArray;
}


if('serviceWorker' in navigator && 'PushManager' in window) //check browser support SW
{
    navigator.serviceWorker.register('sw.js')
        .then((reg) => 
        {
            console.log('SW registered', reg)
            console.log('push is supported');
            swRegisteration = reg;
            initializeIU();
        })
        .catch((err) => console.log('SW not registered', err));
}



function initializeIU()
{
    buttonPush.addEventListener('click', function(){
        buttonPush.disabled = true;
        if(isSubscribed)
        {
            unsubscribeUser();
        }
        else
        {
            subscribeUser();
        }
    });

    swRegisteration.pushManager.getSubscription()
        .then((subscription) => {
            isSubscribed = !(subscription === null);

            if (isSubscribed)
            {
                console.log('user subscribed');
            }
            else
            {
                console.log('user not subscribed')
            }
            updatePushButton();
        });
}

function updatePushButton()
{
    if(Notification.permission === 'denied')
    {
        buttonPush.textContent = 'Push Messaging Blocked';
        buttonPush.disabled = true;
        updateSubscriptionOnServer(null);
        return
    }

    if(isSubscribed)
    {
        buttonPush.textContent = 'Disable Push Messaging';
    }
    else
    {
        buttonPush.textContent = 'Enable Push Messaging';
    }
    buttonPush.disabled = false;
}

function subscribeUser()
{
    const applicationServerKey = urlB64ToUint8Array(publicKey);
    swRegisteration.pushManager.subscribe({
        userVisibleOnly: true,
        applicationServerKey: applicationServerKey
    })
    .then(function(subscription){
        console.log('User is subscribed');
        updateSubscriptionOnServer(subscription);
        isSubscribed = true;
        updatePushButton();
    })
    .catch(function(err){
        console.log('failed to subscribe user', err),
        updatePushButton();
    });
}

function unsubscribeUser()
{
     //Unsub Server
     swRegisteration.pushManager.getSubscription()
     .then(function(subscription){
         if(subscription)
         {
             const key = subscription.getKey('p256dh');
             const token = subscription.getKey('auth');
             fetch('push.php',{
                 method: 'post',
                 headers: new Headers({
                    'Content-Type': 'application/json'
                }),
                body: JSON.stringify({
                    endpoint: subscription.endpoint,
                    key: key ? btoa(String.fromCharCode.apply(null, new Uint8Array(subscription.getKey('p256dh')))) : null,
                    token : token ? btoa(String.fromCharCode.apply(null, new Uint8Array(subscription.getKey('auth')))) : null,
                    axn: 'unsubscribe'
                })
             }).then(function(response){
                 return response.text();
             }).then(function(response){
                 console.log(response);
             }).catch(function(e){
                 console.log('remove from db error', e);
             });
         }
     })

     //Unsub local
    navigator.serviceWorker.ready.then(function(reg)
    {
        reg.pushManager.getSubscription()
        .then(function(subscription){
            subscription.unsubscribe()
            .then(function(success){
                console.log("succussfuly unsubscribed", success)
                isSubscribed = false;
                updatePushButton();
            })
        })
        .catch(function(err){
            console.log('error to unsub', err)
        })
    });
}

function updateSubscriptionOnServer(subscription)
{
    //const subscriptionJSON = document.querySelector('#subscription-json'); 
    
    if(subscription)
    {
        //subscriptionJSON.textContent = JSON.stringify(subscription); //print subsctiption details ke front

        const key = subscription.getKey('p256dh');
        const token = subscription.getKey('auth');

        fetch('push.php', {
            method: 'post',
            headers: new Headers({
                'Content-Type': 'application/json'
            }),
            body: JSON.stringify({
                endpoint: subscription.endpoint,
                key: key ? btoa(String.fromCharCode.apply(null, new Uint8Array(subscription.getKey('p256dh')))) : null,
                token : token ? btoa(String.fromCharCode.apply(null, new Uint8Array(subscription.getKey('auth')))) : null,
                axn: 'subscribe'
            })
        })
        .then(function(response){
            return response.text();
        }).then(function(response){
            console.log(response);
        }).catch(function(e){
            console.log('error', e);
        })
    }
}
