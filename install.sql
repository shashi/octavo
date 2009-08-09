--
-- PostgreSQL database dump
--

SET client_encoding = 'LATIN1';
SET standard_conforming_strings = off;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;

SET search_path = public, pg_catalog;

ALTER TABLE ONLY public.notes DROP CONSTRAINT notes_pkey;
ALTER TABLE public.notes ALTER COLUMN "ID" DROP DEFAULT;
DROP SEQUENCE public."notes_ID_seq";
DROP TABLE public.notes;
--
-- Name: notes; Type: COMMENT; Schema: -; Owner: user
--

COMMENT ON DATABASE notes IS 'Notebook';


--
-- Name: public; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA public;


ALTER SCHEMA public OWNER TO postgres;

--
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON SCHEMA public IS 'standard public schema';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: notes; Type: TABLE; Schema: public; Owner: user; Tablespace: 
--

CREATE TABLE notes (
    "ID" integer NOT NULL,
    "time" timestamp with time zone,
    title character varying(255),
    slug character varying(255),
    contents text,
    tags character varying(1024),
    summary text
);


ALTER TABLE public.notes OWNER TO "user";

--
-- Name: TABLE notes; Type: COMMENT; Schema: public; Owner: user
--

COMMENT ON TABLE notes IS 'Main table';


--
-- Name: notes_ID_seq; Type: SEQUENCE; Schema: public; Owner: user
--

CREATE SEQUENCE "notes_ID_seq"
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public."notes_ID_seq" OWNER TO "user";

--
-- Name: notes_ID_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: user
--

ALTER SEQUENCE "notes_ID_seq" OWNED BY notes."ID";


--
-- Name: ID; Type: DEFAULT; Schema: public; Owner: user
--

ALTER TABLE notes ALTER COLUMN "ID" SET DEFAULT nextval('"notes_ID_seq"'::regclass);


--
-- Name: notes_pkey; Type: CONSTRAINT; Schema: public; Owner: user; Tablespace: 
--

ALTER TABLE ONLY notes
    ADD CONSTRAINT notes_pkey PRIMARY KEY ("ID");


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--
