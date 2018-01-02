--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.10
-- Dumped by pg_dump version 9.5.10

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
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


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: achats; Type: TABLE; Schema: public; Owner: kone
--

CREATE TABLE achats (
    id_ac integer NOT NULL,
    date_ac date DEFAULT now() NOT NULL,
    montant integer,
    montant_paye integer DEFAULT 0 NOT NULL,
    id_fo integer,
    etat_liv character(1) DEFAULT 'N'::bpchar,
    libele character varying(70),
    etat integer DEFAULT 0,
    CONSTRAINT check_montant CHECK ((montant > 0)),
    CONSTRAINT etat_liv_check CHECK (((etat_liv = 'N'::bpchar) OR (etat_liv = 'P'::bpchar) OR (etat_liv = 'T'::bpchar))),
    CONSTRAINT montant_pay_check CHECK (((montant_paye >= 0) AND (montant_paye <= montant)))
);


ALTER TABLE achats OWNER TO kone;

--
-- Name: achats_id_ac_seq; Type: SEQUENCE; Schema: public; Owner: kone
--

CREATE SEQUENCE achats_id_ac_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE achats_id_ac_seq OWNER TO kone;

--
-- Name: achats_id_ac_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: kone
--

ALTER SEQUENCE achats_id_ac_seq OWNED BY achats.id_ac;


--
-- Name: composants; Type: TABLE; Schema: public; Owner: kone
--

CREATE TABLE composants (
    id_pro integer NOT NULL,
    id_ma integer NOT NULL,
    qte_compo double precision
);


ALTER TABLE composants OWNER TO kone;

--
-- Name: contenu_acha; Type: TABLE; Schema: public; Owner: kone
--

CREATE TABLE contenu_acha (
    id_cac integer NOT NULL,
    id_ac integer,
    id_ma integer,
    prix integer NOT NULL,
    qte_ma integer,
    qte_liv integer DEFAULT 0,
    CONSTRAINT check_qte_liv CHECK (((qte_liv >= 0) AND (qte_liv <= qte_ma))),
    CONSTRAINT check_qte_ma CHECK ((qte_ma > 0))
);


ALTER TABLE contenu_acha OWNER TO kone;

--
-- Name: contenu_acha_id_cac_seq; Type: SEQUENCE; Schema: public; Owner: kone
--

CREATE SEQUENCE contenu_acha_id_cac_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE contenu_acha_id_cac_seq OWNER TO kone;

--
-- Name: contenu_acha_id_cac_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: kone
--

ALTER SEQUENCE contenu_acha_id_cac_seq OWNED BY contenu_acha.id_cac;


--
-- Name: contenu_liv; Type: TABLE; Schema: public; Owner: kone
--

CREATE TABLE contenu_liv (
    id_cliv integer NOT NULL,
    id_liv integer NOT NULL,
    id_cac integer,
    qte_l integer DEFAULT 0,
    CONSTRAINT check_qliv CHECK ((qte_l >= 0))
);


ALTER TABLE contenu_liv OWNER TO kone;

--
-- Name: contenu_liv_id_cliv_seq; Type: SEQUENCE; Schema: public; Owner: kone
--

CREATE SEQUENCE contenu_liv_id_cliv_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE contenu_liv_id_cliv_seq OWNER TO kone;

--
-- Name: contenu_liv_id_cliv_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: kone
--

ALTER SEQUENCE contenu_liv_id_cliv_seq OWNED BY contenu_liv.id_cliv;


--
-- Name: contenu_prod; Type: TABLE; Schema: public; Owner: kone
--

CREATE TABLE contenu_prod (
    id_cprod integer NOT NULL,
    id_prod integer,
    id_ma integer,
    qte integer,
    CONSTRAINT check_qte CHECK ((qte > 0))
);


ALTER TABLE contenu_prod OWNER TO kone;

--
-- Name: contenu_prod_id_cprod_seq; Type: SEQUENCE; Schema: public; Owner: kone
--

CREATE SEQUENCE contenu_prod_id_cprod_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE contenu_prod_id_cprod_seq OWNER TO kone;

--
-- Name: contenu_prod_id_cprod_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: kone
--

ALTER SEQUENCE contenu_prod_id_cprod_seq OWNED BY contenu_prod.id_cprod;


--
-- Name: fournisseurs; Type: TABLE; Schema: public; Owner: kone
--

CREATE TABLE fournisseurs (
    id_fo integer NOT NULL,
    nom_fo character varying(20) NOT NULL,
    telephone character varying(20),
    addresse character varying(50)
);


ALTER TABLE fournisseurs OWNER TO kone;

--
-- Name: fournisseurs_id_fo_seq; Type: SEQUENCE; Schema: public; Owner: kone
--

CREATE SEQUENCE fournisseurs_id_fo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE fournisseurs_id_fo_seq OWNER TO kone;

--
-- Name: fournisseurs_id_fo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: kone
--

ALTER SEQUENCE fournisseurs_id_fo_seq OWNED BY fournisseurs.id_fo;


--
-- Name: group_users; Type: TABLE; Schema: public; Owner: kone
--

CREATE TABLE group_users (
    id_g integer NOT NULL,
    nom_g character varying(20),
    id_user integer
);


ALTER TABLE group_users OWNER TO kone;

--
-- Name: group_users_id_g_seq; Type: SEQUENCE; Schema: public; Owner: kone
--

CREATE SEQUENCE group_users_id_g_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE group_users_id_g_seq OWNER TO kone;

--
-- Name: group_users_id_g_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: kone
--

ALTER SEQUENCE group_users_id_g_seq OWNED BY group_users.id_g;


--
-- Name: livraisons; Type: TABLE; Schema: public; Owner: kone
--

CREATE TABLE livraisons (
    id_liv integer NOT NULL,
    id_ac integer,
    date_liv date DEFAULT now() NOT NULL,
    libele character varying(70)
);


ALTER TABLE livraisons OWNER TO kone;

--
-- Name: livraisons_id_liv_seq; Type: SEQUENCE; Schema: public; Owner: kone
--

CREATE SEQUENCE livraisons_id_liv_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE livraisons_id_liv_seq OWNER TO kone;

--
-- Name: livraisons_id_liv_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: kone
--

ALTER SEQUENCE livraisons_id_liv_seq OWNED BY livraisons.id_liv;


--
-- Name: matieres; Type: TABLE; Schema: public; Owner: kone
--

CREATE TABLE matieres (
    id_ma integer NOT NULL,
    nom_ma character varying(25) NOT NULL,
    prix_ma integer,
    qte_reel double precision,
    unite character varying(10),
    qte_vir double precision,
    CONSTRAINT check1 CHECK ((prix_ma > 0)),
    CONSTRAINT check_r CHECK ((qte_reel >= (0)::double precision))
);


ALTER TABLE matieres OWNER TO kone;

--
-- Name: matieres_id_ma_seq; Type: SEQUENCE; Schema: public; Owner: kone
--

CREATE SEQUENCE matieres_id_ma_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE matieres_id_ma_seq OWNER TO kone;

--
-- Name: matieres_id_ma_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: kone
--

ALTER SEQUENCE matieres_id_ma_seq OWNED BY matieres.id_ma;


--
-- Name: payements; Type: TABLE; Schema: public; Owner: kone
--

CREATE TABLE payements (
    id_pay integer NOT NULL,
    id_ac integer,
    date_pay date DEFAULT now() NOT NULL,
    montant integer DEFAULT 0,
    libele character varying(70),
    CONSTRAINT montant_check CHECK ((montant >= 0))
);


ALTER TABLE payements OWNER TO kone;

--
-- Name: payements_id_pay_seq; Type: SEQUENCE; Schema: public; Owner: kone
--

CREATE SEQUENCE payements_id_pay_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE payements_id_pay_seq OWNER TO kone;

--
-- Name: payements_id_pay_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: kone
--

ALTER SEQUENCE payements_id_pay_seq OWNED BY payements.id_pay;


--
-- Name: productions; Type: TABLE; Schema: public; Owner: kone
--

CREATE TABLE productions (
    id_prod integer NOT NULL,
    id_pro integer,
    date_prod date DEFAULT now(),
    qte integer,
    libele character varying(70),
    etat integer DEFAULT 0,
    CONSTRAINT check_qte CHECK ((qte > 0))
);


ALTER TABLE productions OWNER TO kone;

--
-- Name: productions_id_prod_seq; Type: SEQUENCE; Schema: public; Owner: kone
--

CREATE SEQUENCE productions_id_prod_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE productions_id_prod_seq OWNER TO kone;

--
-- Name: productions_id_prod_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: kone
--

ALTER SEQUENCE productions_id_prod_seq OWNED BY productions.id_prod;


--
-- Name: produits; Type: TABLE; Schema: public; Owner: kone
--

CREATE TABLE produits (
    id_pro integer NOT NULL,
    nom_pro character varying(15) NOT NULL,
    qte_pro integer NOT NULL,
    CONSTRAINT check1 CHECK ((qte_pro > 0)),
    CONSTRAINT check_qtep CHECK ((qte_pro > 0))
);


ALTER TABLE produits OWNER TO kone;

--
-- Name: produits_id_pro_seq; Type: SEQUENCE; Schema: public; Owner: kone
--

CREATE SEQUENCE produits_id_pro_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE produits_id_pro_seq OWNER TO kone;

--
-- Name: produits_id_pro_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: kone
--

ALTER SEQUENCE produits_id_pro_seq OWNED BY produits.id_pro;


--
-- Name: users; Type: TABLE; Schema: public; Owner: kone
--

CREATE TABLE users (
    id_user integer NOT NULL,
    nom_user character varying(20) NOT NULL,
    password character varying(100) NOT NULL,
    id_g integer DEFAULT 2
);


ALTER TABLE users OWNER TO kone;

--
-- Name: users_id_user_seq; Type: SEQUENCE; Schema: public; Owner: kone
--

CREATE SEQUENCE users_id_user_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE users_id_user_seq OWNER TO kone;

--
-- Name: users_id_user_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: kone
--

ALTER SEQUENCE users_id_user_seq OWNED BY users.id_user;


--
-- Name: id_ac; Type: DEFAULT; Schema: public; Owner: kone
--

ALTER TABLE ONLY achats ALTER COLUMN id_ac SET DEFAULT nextval('achats_id_ac_seq'::regclass);


--
-- Name: id_cac; Type: DEFAULT; Schema: public; Owner: kone
--

ALTER TABLE ONLY contenu_acha ALTER COLUMN id_cac SET DEFAULT nextval('contenu_acha_id_cac_seq'::regclass);


--
-- Name: id_cliv; Type: DEFAULT; Schema: public; Owner: kone
--

ALTER TABLE ONLY contenu_liv ALTER COLUMN id_cliv SET DEFAULT nextval('contenu_liv_id_cliv_seq'::regclass);


--
-- Name: id_cprod; Type: DEFAULT; Schema: public; Owner: kone
--

ALTER TABLE ONLY contenu_prod ALTER COLUMN id_cprod SET DEFAULT nextval('contenu_prod_id_cprod_seq'::regclass);


--
-- Name: id_fo; Type: DEFAULT; Schema: public; Owner: kone
--

ALTER TABLE ONLY fournisseurs ALTER COLUMN id_fo SET DEFAULT nextval('fournisseurs_id_fo_seq'::regclass);


--
-- Name: id_g; Type: DEFAULT; Schema: public; Owner: kone
--

ALTER TABLE ONLY group_users ALTER COLUMN id_g SET DEFAULT nextval('group_users_id_g_seq'::regclass);


--
-- Name: id_liv; Type: DEFAULT; Schema: public; Owner: kone
--

ALTER TABLE ONLY livraisons ALTER COLUMN id_liv SET DEFAULT nextval('livraisons_id_liv_seq'::regclass);


--
-- Name: id_ma; Type: DEFAULT; Schema: public; Owner: kone
--

ALTER TABLE ONLY matieres ALTER COLUMN id_ma SET DEFAULT nextval('matieres_id_ma_seq'::regclass);


--
-- Name: id_pay; Type: DEFAULT; Schema: public; Owner: kone
--

ALTER TABLE ONLY payements ALTER COLUMN id_pay SET DEFAULT nextval('payements_id_pay_seq'::regclass);


--
-- Name: id_prod; Type: DEFAULT; Schema: public; Owner: kone
--

ALTER TABLE ONLY productions ALTER COLUMN id_prod SET DEFAULT nextval('productions_id_prod_seq'::regclass);


--
-- Name: id_pro; Type: DEFAULT; Schema: public; Owner: kone
--

ALTER TABLE ONLY produits ALTER COLUMN id_pro SET DEFAULT nextval('produits_id_pro_seq'::regclass);


--
-- Name: id_user; Type: DEFAULT; Schema: public; Owner: kone
--

ALTER TABLE ONLY users ALTER COLUMN id_user SET DEFAULT nextval('users_id_user_seq'::regclass);


--
-- Data for Name: achats; Type: TABLE DATA; Schema: public; Owner: kone
--

COPY achats (id_ac, date_ac, montant, montant_paye, id_fo, etat_liv, libele, etat) FROM stdin;
\.


--
-- Name: achats_id_ac_seq; Type: SEQUENCE SET; Schema: public; Owner: kone
--

SELECT pg_catalog.setval('achats_id_ac_seq', 147, true);


--
-- Data for Name: composants; Type: TABLE DATA; Schema: public; Owner: kone
--

COPY composants (id_pro, id_ma, qte_compo) FROM stdin;
2	87	2
2	115	1
1	87	2
1	115	1
4	115	1
3	115	1
2	80	3
2	108	7.5
4	112	7.5
4	80	3
3	80	2
3	108	7.5
1	80	2
1	108	7.5
4	87	3
\.


--
-- Data for Name: contenu_acha; Type: TABLE DATA; Schema: public; Owner: kone
--

COPY contenu_acha (id_cac, id_ac, id_ma, prix, qte_ma, qte_liv) FROM stdin;
\.


--
-- Name: contenu_acha_id_cac_seq; Type: SEQUENCE SET; Schema: public; Owner: kone
--

SELECT pg_catalog.setval('contenu_acha_id_cac_seq', 203, true);


--
-- Data for Name: contenu_liv; Type: TABLE DATA; Schema: public; Owner: kone
--

COPY contenu_liv (id_cliv, id_liv, id_cac, qte_l) FROM stdin;
\.


--
-- Name: contenu_liv_id_cliv_seq; Type: SEQUENCE SET; Schema: public; Owner: kone
--

SELECT pg_catalog.setval('contenu_liv_id_cliv_seq', 210, true);


--
-- Data for Name: contenu_prod; Type: TABLE DATA; Schema: public; Owner: kone
--

COPY contenu_prod (id_cprod, id_prod, id_ma, qte) FROM stdin;
352	128	87	2
353	128	115	1
354	128	80	2
355	128	108	8
356	129	115	1
357	129	112	8
358	129	80	3
359	129	87	3
\.


--
-- Name: contenu_prod_id_cprod_seq; Type: SEQUENCE SET; Schema: public; Owner: kone
--

SELECT pg_catalog.setval('contenu_prod_id_cprod_seq', 359, true);


--
-- Data for Name: fournisseurs; Type: TABLE DATA; Schema: public; Owner: kone
--

COPY fournisseurs (id_fo, nom_fo, telephone, addresse) FROM stdin;
3	FITINI MARKET	20 55 34 34	Grande marché
2	MONOPRIX	20 10 10 10	Djelibougou
4	DUNKAFA	20 55 34 34	Dibidani
5	GGB	20 12 13 14	Grande marché
24	SDS	20 63 63 63	Tokorobougou
77	GALADIO	77 88 99 01	Banconi
80	SOCOLAIT	20 99 99 00	Djelibougou
81	MARKTY ONE	21 33 44 45	Badalabougou
82	IBN DAOUD	97 89 89 55	Hippodrome 2
85	SIM-NOUR	77 88 99 00	Soghoniko
88	SID_COM	22 77 66 87	Djicoroni
1	7ONZE	20 17 16 15	Fadjiguila
\.


--
-- Name: fournisseurs_id_fo_seq; Type: SEQUENCE SET; Schema: public; Owner: kone
--

SELECT pg_catalog.setval('fournisseurs_id_fo_seq', 88, true);


--
-- Data for Name: group_users; Type: TABLE DATA; Schema: public; Owner: kone
--

COPY group_users (id_g, nom_g, id_user) FROM stdin;
1	Comptable	1
2	Gerance	2
3	Administarteur	3
4	production	4
\.


--
-- Name: group_users_id_g_seq; Type: SEQUENCE SET; Schema: public; Owner: kone
--

SELECT pg_catalog.setval('group_users_id_g_seq', 4, true);


--
-- Data for Name: livraisons; Type: TABLE DATA; Schema: public; Owner: kone
--

COPY livraisons (id_liv, id_ac, date_liv, libele) FROM stdin;
\.


--
-- Name: livraisons_id_liv_seq; Type: SEQUENCE SET; Schema: public; Owner: kone
--

SELECT pg_catalog.setval('livraisons_id_liv_seq', 88, true);


--
-- Data for Name: matieres; Type: TABLE DATA; Schema: public; Owner: kone
--

COPY matieres (id_ma, nom_ma, prix_ma, qte_reel, unite, qte_vir) FROM stdin;
95	Grain_du_dèguè	500	0	kg	0
111	Essence_cocktail	250	0	ml	0
112	Essence_ananas	250	0	ml	-37.5
115	Ferment	1250	23	ml	21.2000000000000028
80	Lait_en_poudre	2040	45	kg	71
87	Sucre	550	45	kg	175
98	Moyen_bidon	100	0	p	0
99	Petit_bidon	65	0	p	0
109	Essence_fraise	250	0	ml	0
110	Essence_banane	250	0	ml	0
103	Petit_sachet	100	0	pq	0
101	Grand_sachet	250	0	pq	0
102	Moyen_sachet	150	0	pq	0
100	Grand_pot	60	0	p	0
97	Grand_bidon	125	0	p	0
108	Essence_vanille	250	7.5	ml	5
\.


--
-- Name: matieres_id_ma_seq; Type: SEQUENCE SET; Schema: public; Owner: kone
--

SELECT pg_catalog.setval('matieres_id_ma_seq', 115, true);


--
-- Data for Name: payements; Type: TABLE DATA; Schema: public; Owner: kone
--

COPY payements (id_pay, id_ac, date_pay, montant, libele) FROM stdin;
\.


--
-- Name: payements_id_pay_seq; Type: SEQUENCE SET; Schema: public; Owner: kone
--

SELECT pg_catalog.setval('payements_id_pay_seq', 103, true);


--
-- Data for Name: productions; Type: TABLE DATA; Schema: public; Owner: kone
--

COPY productions (id_prod, id_pro, date_prod, qte, libele, etat) FROM stdin;
128	1	2017-11-04	20	PRO YAOURT B	1
129	4	2017-11-04	20	 DEGEUEPRO	1
\.


--
-- Name: productions_id_prod_seq; Type: SEQUENCE SET; Schema: public; Owner: kone
--

SELECT pg_catalog.setval('productions_id_prod_seq', 129, true);


--
-- Data for Name: produits; Type: TABLE DATA; Schema: public; Owner: kone
--

COPY produits (id_pro, nom_pro, qte_pro) FROM stdin;
3	Fene	20
2	Yaourt_pot	20
4	Dèguè	20
1	Yaourt_bidon	20
\.


--
-- Name: produits_id_pro_seq; Type: SEQUENCE SET; Schema: public; Owner: kone
--

SELECT pg_catalog.setval('produits_id_pro_seq', 15, true);


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: kone
--

COPY users (id_user, nom_user, password, id_g) FROM stdin;
2	gerant	bad8527ef81368cb87760ad3ac428d96	2
1	comptable	965b18a1baca384994214a8078254da1	1
3	admin	0c6b67d1216f3739ff0971d32ef7679e	3
4	producteur	68f8898e295d0a300b7d3929157b142b	4
\.


--
-- Name: users_id_user_seq; Type: SEQUENCE SET; Schema: public; Owner: kone
--

SELECT pg_catalog.setval('users_id_user_seq', 4, true);


--
-- Name: achats_pkey; Type: CONSTRAINT; Schema: public; Owner: kone
--

ALTER TABLE ONLY achats
    ADD CONSTRAINT achats_pkey PRIMARY KEY (id_ac);


--
-- Name: contenu_acha_pkey; Type: CONSTRAINT; Schema: public; Owner: kone
--

ALTER TABLE ONLY contenu_acha
    ADD CONSTRAINT contenu_acha_pkey PRIMARY KEY (id_cac);


--
-- Name: contenu_liv_pkey; Type: CONSTRAINT; Schema: public; Owner: kone
--

ALTER TABLE ONLY contenu_liv
    ADD CONSTRAINT contenu_liv_pkey PRIMARY KEY (id_cliv);


--
-- Name: contenu_prod_pkey; Type: CONSTRAINT; Schema: public; Owner: kone
--

ALTER TABLE ONLY contenu_prod
    ADD CONSTRAINT contenu_prod_pkey PRIMARY KEY (id_cprod);


--
-- Name: fournisseurs_pkey; Type: CONSTRAINT; Schema: public; Owner: kone
--

ALTER TABLE ONLY fournisseurs
    ADD CONSTRAINT fournisseurs_pkey PRIMARY KEY (id_fo);


--
-- Name: fournisseurs_uniq; Type: CONSTRAINT; Schema: public; Owner: kone
--

ALTER TABLE ONLY fournisseurs
    ADD CONSTRAINT fournisseurs_uniq UNIQUE (nom_fo);


--
-- Name: livraisons_pkey; Type: CONSTRAINT; Schema: public; Owner: kone
--

ALTER TABLE ONLY livraisons
    ADD CONSTRAINT livraisons_pkey PRIMARY KEY (id_liv);


--
-- Name: matieres_pkey; Type: CONSTRAINT; Schema: public; Owner: kone
--

ALTER TABLE ONLY matieres
    ADD CONSTRAINT matieres_pkey PRIMARY KEY (id_ma);


--
-- Name: matieres_uniq; Type: CONSTRAINT; Schema: public; Owner: kone
--

ALTER TABLE ONLY matieres
    ADD CONSTRAINT matieres_uniq UNIQUE (nom_ma);


--
-- Name: payements_pkey; Type: CONSTRAINT; Schema: public; Owner: kone
--

ALTER TABLE ONLY payements
    ADD CONSTRAINT payements_pkey PRIMARY KEY (id_pay);


--
-- Name: primary_key1; Type: CONSTRAINT; Schema: public; Owner: kone
--

ALTER TABLE ONLY users
    ADD CONSTRAINT primary_key1 PRIMARY KEY (id_user);


--
-- Name: pro_pkey; Type: CONSTRAINT; Schema: public; Owner: kone
--

ALTER TABLE ONLY produits
    ADD CONSTRAINT pro_pkey PRIMARY KEY (id_pro);


--
-- Name: prod_pkey; Type: CONSTRAINT; Schema: public; Owner: kone
--

ALTER TABLE ONLY productions
    ADD CONSTRAINT prod_pkey PRIMARY KEY (id_prod);


--
-- Name: produits_uniq; Type: CONSTRAINT; Schema: public; Owner: kone
--

ALTER TABLE ONLY produits
    ADD CONSTRAINT produits_uniq UNIQUE (nom_pro);


--
-- Name: uniq_1; Type: CONSTRAINT; Schema: public; Owner: kone
--

ALTER TABLE ONLY users
    ADD CONSTRAINT uniq_1 UNIQUE (nom_user);


--
-- Name: unique_comp; Type: CONSTRAINT; Schema: public; Owner: kone
--

ALTER TABLE ONLY composants
    ADD CONSTRAINT unique_comp UNIQUE (id_ma, id_pro);


--
-- Name: unique_id; Type: CONSTRAINT; Schema: public; Owner: kone
--

ALTER TABLE ONLY contenu_acha
    ADD CONSTRAINT unique_id UNIQUE (id_ma, id_ac);


--
-- Name: unique_id_ma_id_prod; Type: CONSTRAINT; Schema: public; Owner: kone
--

ALTER TABLE ONLY contenu_prod
    ADD CONSTRAINT unique_id_ma_id_prod UNIQUE (id_ma, id_prod);


--
-- Name: achats_fkey; Type: FK CONSTRAINT; Schema: public; Owner: kone
--

ALTER TABLE ONLY achats
    ADD CONSTRAINT achats_fkey FOREIGN KEY (id_fo) REFERENCES fournisseurs(id_fo) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: composants_fkey2; Type: FK CONSTRAINT; Schema: public; Owner: kone
--

ALTER TABLE ONLY composants
    ADD CONSTRAINT composants_fkey2 FOREIGN KEY (id_pro) REFERENCES produits(id_pro) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: contenu_ac_fkey1; Type: FK CONSTRAINT; Schema: public; Owner: kone
--

ALTER TABLE ONLY contenu_acha
    ADD CONSTRAINT contenu_ac_fkey1 FOREIGN KEY (id_ac) REFERENCES achats(id_ac) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: contenu_ac_fkey2; Type: FK CONSTRAINT; Schema: public; Owner: kone
--

ALTER TABLE ONLY contenu_acha
    ADD CONSTRAINT contenu_ac_fkey2 FOREIGN KEY (id_ma) REFERENCES matieres(id_ma) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: contenu_liv_fkey; Type: FK CONSTRAINT; Schema: public; Owner: kone
--

ALTER TABLE ONLY contenu_liv
    ADD CONSTRAINT contenu_liv_fkey FOREIGN KEY (id_liv) REFERENCES livraisons(id_liv) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: contenu_liv_fkey2; Type: FK CONSTRAINT; Schema: public; Owner: kone
--

ALTER TABLE ONLY contenu_liv
    ADD CONSTRAINT contenu_liv_fkey2 FOREIGN KEY (id_cac) REFERENCES contenu_acha(id_cac) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: contenu_prod_fkey; Type: FK CONSTRAINT; Schema: public; Owner: kone
--

ALTER TABLE ONLY contenu_prod
    ADD CONSTRAINT contenu_prod_fkey FOREIGN KEY (id_prod) REFERENCES productions(id_prod) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: contenu_prod_fkey2; Type: FK CONSTRAINT; Schema: public; Owner: kone
--

ALTER TABLE ONLY contenu_prod
    ADD CONSTRAINT contenu_prod_fkey2 FOREIGN KEY (id_ma) REFERENCES matieres(id_ma) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: f_key_composant; Type: FK CONSTRAINT; Schema: public; Owner: kone
--

ALTER TABLE ONLY composants
    ADD CONSTRAINT f_key_composant FOREIGN KEY (id_ma) REFERENCES matieres(id_ma) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: livraisons_fkey; Type: FK CONSTRAINT; Schema: public; Owner: kone
--

ALTER TABLE ONLY livraisons
    ADD CONSTRAINT livraisons_fkey FOREIGN KEY (id_ac) REFERENCES achats(id_ac) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: payements_fkey; Type: FK CONSTRAINT; Schema: public; Owner: kone
--

ALTER TABLE ONLY payements
    ADD CONSTRAINT payements_fkey FOREIGN KEY (id_ac) REFERENCES achats(id_ac) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: prod_fkey; Type: FK CONSTRAINT; Schema: public; Owner: kone
--

ALTER TABLE ONLY productions
    ADD CONSTRAINT prod_fkey FOREIGN KEY (id_pro) REFERENCES produits(id_pro) ON UPDATE CASCADE ON DELETE CASCADE;


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

