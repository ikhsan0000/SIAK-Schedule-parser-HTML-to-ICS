const buttonPush = document.querySelector("#push");

const publicKey = `BIldUkr0kQ_hlQOUFSCpVQeleXS7pErhkUQNOrJX9lXyAGIPFxf1IdxDm_gjIZbNwhK1nKC4gzD4D7mqXxM2KTM`
// private key sQxIz5gxC4UYPMo12GU8Rafv4So-LA-OqTsVuu7d9c

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

function updateSubscriptionOnServer(subscription)
{
    const subscriptionJSON = document.querySelector('#subscription-json');   
    if(subscription)
    {
        subscriptionJSON.textContent = JSON.stringify(subscription);
    }
}