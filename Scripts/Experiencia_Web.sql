PROMPT
PROMPT Deletando Objetos Antigos... [Tabelas,Indices,Constraints,Sequencias...]

DROP SEQUENCE EXPERIENCIA_WEB_SEQ;
DROP TABLE EXPERIENCIA_WEB;


REM *****************************************************************************************
REM *** CRIACAO DA TABELA DE EXPERIENCIA_WEB 
REM *****************************************************************************************
PROMPT
PROMPT Criando Tabela EXPERIENCIA_WEB...

CREATE TABLE EXPERIENCIA_WEB(
CHAVE                   	NUMBER           	NOT NULL,
CHAVE_USUARIO_WEB		NUMBER			NOT NULL,
EMPRESA				VARCHAR2(255)		NOT NULL,
CIDADE         			NUMBER			NOT NULL,
CARGO				VARCHAR2(255)		NOT NULL,
DATA_INICIO		      	DATE			NULL,
DATA_TERMINO			DATE			NULL,
RESUMO				VARCHAR2(255)		NULL);

REM *****************************************************************************************
REM *** INDICES
REM *****************************************************************************************
PROMPT 
PROMPT Criando Indices...

ALTER TABLE EXPERIENCIA_WEB ADD(CONSTRAINT EXPERIENCIA_WEB_PK PRIMARY KEY(CHAVE))
/
ALTER INDEX EXPERIENCIA_WEB_PK REBUILD TABLESPACE GESTAO_IDX;
---------------------------------------------------------------------------------------------

REM *****************************************************************************************
REM *** SEQUENCIAS
REM *****************************************************************************************
PROMPT 
PROMPT Criando Sequencias...

CREATE SEQUENCE EXPERIENCIA_WEB_SEQ
INCREMENT BY 1
NOMINVALUE 
NOMAXVALUE
NOCYCLE 
NOCACHE
ORDER;