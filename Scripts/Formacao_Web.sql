PROMPT
PROMPT Deletando Objetos Antigos... [Tabelas,Indices,Constraints,Sequencias...]

DROP SEQUENCE FORMACAO_WEB_SEQ;
DROP TABLE FORMACAO_WEB;


REM *****************************************************************************************
REM *** CRIACAO DA TABELA DE FORMACAO_WEB 
REM *****************************************************************************************
PROMPT
PROMPT Criando Tabela FORMACAO_WEB...

CREATE TABLE FORMACAO_WEB(
CHAVE                   	NUMBER           	NOT NULL,
CHAVE_USUARIO_WEB		NUMBER			NOT NULL,
DESCRICAO			VARCHAR2(255)		NOT NULL,
INSTITUICAO			VARCHAR2(255)		NOT NULL,
CIDADE         			NUMBER			NOT NULL,
DATA_INICIO		      	DATE			NULL,
DATA_TERMINO			DATE			NULL,
TIPO				VARCHAR2(1)		NOT NULL);

REM *****************************************************************************************
REM *** INDICES
REM *****************************************************************************************
PROMPT 
PROMPT Criando Indices...

ALTER TABLE FORMACAO_WEB ADD(CONSTRAINT FORMACAO_WEB_PK PRIMARY KEY(CHAVE))
/
ALTER INDEX FORMACAO_WEB_PK REBUILD TABLESPACE GESTAO_IDX;
---------------------------------------------------------------------------------------------

REM *****************************************************************************************
REM *** SEQUENCIAS
REM *****************************************************************************************
PROMPT 
PROMPT Criando Sequencias...

CREATE SEQUENCE FORMACAO_WEB_SEQ
INCREMENT BY 1
NOMINVALUE 
NOMAXVALUE
NOCYCLE 
NOCACHE
ORDER;