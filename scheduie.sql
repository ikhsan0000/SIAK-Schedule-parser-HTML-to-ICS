--
-- PostgreSQL database dump
--

-- Dumped from database version 10.10
-- Dumped by pg_dump version 10.10

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: acara; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.acara (
    org text NOT NULL,
    nama_acara text NOT NULL,
    deskripsi text NOT NULL,
    tanggal text NOT NULL,
    hari text NOT NULL,
    waktu_mulai integer NOT NULL,
    waktu_selesai integer NOT NULL,
    sent integer,
    id integer NOT NULL
);


ALTER TABLE public.acara OWNER TO postgres;

--
-- Name: acara_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.acara_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.acara_id_seq OWNER TO postgres;

--
-- Name: acara_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.acara_id_seq OWNED BY public.acara.id;


--
-- Name: jadwal; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.jadwal (
    id integer NOT NULL,
    hari text NOT NULL,
    waktu_mulai integer NOT NULL,
    waktu_selesai integer NOT NULL,
    nama_matkul text NOT NULL
);


ALTER TABLE public.jadwal OWNER TO postgres;

--
-- Name: user_list; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.user_list (
    nama text NOT NULL,
    id integer NOT NULL,
    email text NOT NULL
);


ALTER TABLE public.user_list OWNER TO postgres;

--
-- Name: acara id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.acara ALTER COLUMN id SET DEFAULT nextval('public.acara_id_seq'::regclass);


--
-- Data for Name: acara; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.acara (org, nama_acara, deskripsi, tanggal, hari, waktu_mulai, waktu_selesai, sent, id) FROM stdin;
\.


--
-- Data for Name: jadwal; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.jadwal (id, hari, waktu_mulai, waktu_selesai, nama_matkul) FROM stdin;
\.


--
-- Data for Name: user_list; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.user_list (nama, id, email) FROM stdin;
\.


--
-- Name: acara_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.acara_id_seq', 13, true);


--
-- Name: user_list user_list_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_list
    ADD CONSTRAINT user_list_pkey PRIMARY KEY (id);


--
-- Name: jadwal jadwal_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jadwal
    ADD CONSTRAINT jadwal_id_fkey FOREIGN KEY (id) REFERENCES public.user_list(id);


--
-- PostgreSQL database dump complete
--

