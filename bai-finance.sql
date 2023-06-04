/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de cr�ation :  14/02/2023 04:16:16                      */
/*==============================================================*/


drop table if exists AGENCE;

drop table if exists BANQUE;

drop table if exists CLIENT;

drop table if exists COMPTE;

drop table if exists EMPLOYE;

drop table if exists GERER;

drop table if exists OPERATION;

drop table if exists TYPE_COMPTE;

drop table if exists TYPE_OPERATION;

drop table if exists VILLE;

/*==============================================================*/
/* Table : AGENCE                                               */
/*==============================================================*/
create table AGENCE
(
   IDAG                 varchar(8) not null,
   IDVLL                varchar(8),
   IDBQ                 varchar(8) not null,
   NOMAG                varchar(20) not null,
   primary key (IDAG)
);

/*==============================================================*/
/* Table : BANQUE                                               */
/*==============================================================*/
create table BANQUE
(
   IDBQ                 varchar(8) not null,
   NOMBQ                varchar(20) not null,
   primary key (IDBQ)
);

/*==============================================================*/
/* Table : CLIENT                                               */
/*==============================================================*/
create table CLIENT
(
   IDCLT                varchar(9) not null,
   NOM                  varchar(30) not null,
   PRENOM               varchar(20),
   SEXE                  varchar(14) not null,
   DATENAIS             date not null,
   LIEUNAIS             varchar(20) not null,
   PROFESSION           varchar(20) not null,
   PAYS                 varchar(15) not null,
   VILLE                varchar(15) not null,
   QUARTIER             varchar(15),
   TEL                  varchar(13) not null,
   EMAIL                varchar(30),
   PASSWORD             varchar(30) not null,
   PROFIL               longblob,
   DATECREAT            timestamp not null,
   primary key (IDCLT)
);

/*==============================================================*/
/* Table : COMPTE                                               */
/*==============================================================*/
create table COMPTE
(
   IDCPTE               varchar(8) not null,
   IDAG                 varchar(8),
   IDCLT                varchar(6) not null,
   IDTY_CPTE            varchar(8) not null,
   SOLDE                numeric(8,0),
   DATECREA             date not null,
   TYPECPTE             varchar(15) not null,
   DATECREATE           date,
   primary key (IDCPTE)
);

/*==============================================================*/
/* Table : EMPLOYE                                              */
/*==============================================================*/
create table EMPLOYE
(
   IDEMP                varchar(8) not null,
   NOMEMP               varchar(20) not null,
   PRENOMEMP            varchar(20),
   SEXEEMP              varchar(12) not null,
   DATENAISEMP          date not null,
   PROFIL               longblob,
   STATUT               varchar(10) not null,
   DATEEMB              date not null,
   SALAIRE              numeric(8,0),
   primary key (IDEMP)
);

/*==============================================================*/
/* Table : GERER                                                */
/*==============================================================*/
create table GERER
(
   IDEMP                varchar(8) not null,
   IDCPTE               varchar(8) not null,
   primary key (IDEMP, IDCPTE)
);

/*==============================================================*/
/* Table : OPERATION                                            */
/*==============================================================*/
create table OPERATION
(
   IDOP                 varchar(8) not null,
   IDCPTE               varchar(8) not null,
   IDTY_OP              varchar(8) not null,
   MONTANTOP            numeric(8,0) not null,
   DATEOP               datetime not null,
   primary key (IDOP)
);

/*==============================================================*/
/* Table : TYPE_COMPTE                                          */
/*==============================================================*/
create table TYPE_COMPTE
(
   IDTY_CPTE            varchar(8) not null,
   NOMTYPE              varchar(20) not null,
   primary key (IDTY_CPTE)
);

/*==============================================================*/
/* Table : TYPE_OPERATION                                       */
/*==============================================================*/
create table TYPE_OPERATION
(
   IDTY_OP              varchar(8) not null,
   LIBELLEOP            varchar(20) not null,
   primary key (IDTY_OP)
);

/*==============================================================*/
/* Table : VILLE                                                */
/*==============================================================*/
create table VILLE
(
   IDVLL                varchar(8) not null,
   NONVLL               varchar(20) not null,
   primary key (IDVLL)
);

alter table AGENCE add constraint FK_POSSEDER foreign key (IDBQ)
      references BANQUE (IDBQ) on delete restrict on update restrict;

alter table AGENCE add constraint FK_SITUER foreign key (IDVLL)
      references VILLE (IDVLL) on delete restrict on update restrict;

alter table COMPTE add constraint FK_ETRE foreign key (IDTY_CPTE)
      references TYPE_COMPTE (IDTY_CPTE) on delete restrict on update restrict;

alter table COMPTE add constraint FK_LOGER foreign key (IDAG)
      references AGENCE (IDAG) on delete restrict on update restrict;

alter table COMPTE add constraint FK_OUVRIR foreign key (IDCLT)
      references CLIENT (IDCLT) on delete restrict on update restrict;

alter table GERER add constraint FK_GERER foreign key (IDCPTE)
      references COMPTE (IDCPTE) on delete restrict on update restrict;

alter table GERER add constraint FK_GERER2 foreign key (IDEMP)
      references EMPLOYE (IDEMP) on delete restrict on update restrict;

alter table OPERATION add constraint FK_CONCERNER foreign key (IDTY_OP)
      references TYPE_OPERATION (IDTY_OP) on delete restrict on update restrict;

alter table OPERATION add constraint FK_EFFECTUER foreign key (IDCPTE)
      references COMPTE (IDCPTE) on delete restrict on update restrict;

