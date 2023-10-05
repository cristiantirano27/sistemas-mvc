PGDMP                      	    {         	   soccerapp    13.3    13.3     �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    49322 	   soccerapp    DATABASE     h   CREATE DATABASE soccerapp WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'Spanish_Colombia.1252';
    DROP DATABASE soccerapp;
                postgres    false            �            1259    49328    Equipos    TABLE     ]   CREATE TABLE public."Equipos" (
    id integer NOT NULL,
    nombre character varying(30)
);
    DROP TABLE public."Equipos";
       public         heap    postgres    false            �            1259    49326    Equipos_id_seq    SEQUENCE     �   CREATE SEQUENCE public."Equipos_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public."Equipos_id_seq";
       public          postgres    false    201            �           0    0    Equipos_id_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public."Equipos_id_seq" OWNED BY public."Equipos".id;
          public          postgres    false    200            �            1259    49336    Jornadas    TABLE     a   CREATE TABLE public."Jornadas" (
    id integer NOT NULL,
    jornada integer,
    fecha date
);
    DROP TABLE public."Jornadas";
       public         heap    postgres    false            �            1259    49334    Jornadas_id_seq    SEQUENCE     �   CREATE SEQUENCE public."Jornadas_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public."Jornadas_id_seq";
       public          postgres    false    203            �           0    0    Jornadas_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public."Jornadas_id_seq" OWNED BY public."Jornadas".id;
          public          postgres    false    202            �            1259    49344    Partidos    TABLE     �   CREATE TABLE public."Partidos" (
    id integer NOT NULL,
    jornada integer,
    fecha date,
    orden integer,
    "idLocal" integer,
    "idVisitante" integer,
    "golesLocal" integer,
    "golesVisitante" integer
);
    DROP TABLE public."Partidos";
       public         heap    postgres    false            �            1259    49342    Partidos_id_seq    SEQUENCE     �   CREATE SEQUENCE public."Partidos_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public."Partidos_id_seq";
       public          postgres    false    205            �           0    0    Partidos_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public."Partidos_id_seq" OWNED BY public."Partidos".id;
          public          postgres    false    204            .           2604    49331 
   Equipos id    DEFAULT     l   ALTER TABLE ONLY public."Equipos" ALTER COLUMN id SET DEFAULT nextval('public."Equipos_id_seq"'::regclass);
 ;   ALTER TABLE public."Equipos" ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    201    200    201            /           2604    49339    Jornadas id    DEFAULT     n   ALTER TABLE ONLY public."Jornadas" ALTER COLUMN id SET DEFAULT nextval('public."Jornadas_id_seq"'::regclass);
 <   ALTER TABLE public."Jornadas" ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    203    202    203            0           2604    49347    Partidos id    DEFAULT     n   ALTER TABLE ONLY public."Partidos" ALTER COLUMN id SET DEFAULT nextval('public."Partidos_id_seq"'::regclass);
 <   ALTER TABLE public."Partidos" ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    205    204    205            �          0    49328    Equipos 
   TABLE DATA           /   COPY public."Equipos" (id, nombre) FROM stdin;
    public          postgres    false    201   �       �          0    49336    Jornadas 
   TABLE DATA           8   COPY public."Jornadas" (id, jornada, fecha) FROM stdin;
    public          postgres    false    203   �       �          0    49344    Partidos 
   TABLE DATA           y   COPY public."Partidos" (id, jornada, fecha, orden, "idLocal", "idVisitante", "golesLocal", "golesVisitante") FROM stdin;
    public          postgres    false    205   �       �           0    0    Equipos_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public."Equipos_id_seq"', 1, false);
          public          postgres    false    200            �           0    0    Jornadas_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public."Jornadas_id_seq"', 1, false);
          public          postgres    false    202            �           0    0    Partidos_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public."Partidos_id_seq"', 1, false);
          public          postgres    false    204            2           2606    49333    Equipos Equipos_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public."Equipos"
    ADD CONSTRAINT "Equipos_pkey" PRIMARY KEY (id);
 B   ALTER TABLE ONLY public."Equipos" DROP CONSTRAINT "Equipos_pkey";
       public            postgres    false    201            4           2606    49341    Jornadas Jornadas_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public."Jornadas"
    ADD CONSTRAINT "Jornadas_pkey" PRIMARY KEY (id);
 D   ALTER TABLE ONLY public."Jornadas" DROP CONSTRAINT "Jornadas_pkey";
       public            postgres    false    203            6           2606    49349    Partidos Partidos_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public."Partidos"
    ADD CONSTRAINT "Partidos_pkey" PRIMARY KEY (id);
 D   ALTER TABLE ONLY public."Partidos" DROP CONSTRAINT "Partidos_pkey";
       public            postgres    false    205            �      x������ � �      �      x������ � �      �      x������ � �     