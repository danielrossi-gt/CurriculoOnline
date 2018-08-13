PROMPT
PROMPT Deletando Objetos Antigos... [Tabelas,Indices,Constraints,Sequencias...]

DROP TABLE USUARIOS_WEB;
DROP SEQUENCE USUARIOS_WEB_SEQ;

REM *****************************************************************************************
REM *** CRIACAO DA TABELA DE USUARIOS
REM *****************************************************************************************
PROMPT
PROMPT Criando Tabela Usuarios...

CREATE TABLE USUARIOS_WEB (
  CHAVE		NUMBER 		NOT NULL,
  CODIGO_BASE	NUMBER		NOT NULL,
  CPF		VARCHAR2(14)	NOT NULL,
  SENHA		VARCHAR2(50)	NOT NULL);
  
REM *****************************************************************************************
REM *** INDICES
REM *****************************************************************************************
PROMPT 
PROMPT Criando Indices...

---------------------------------------------------------------------------------------------
ALTER TABLE USUARIOS_WEB ADD(CONSTRAINT USUARIOS_WEB_PK	PRIMARY KEY (CHAVE))
/
ALTER INDEX USUARIOS_WEB_PK REBUILD TABLESPACE MPH_IDX;
---------------------------------------------------------------------------------------------
CREATE UNIQUE INDEX USUARIOS_WEB_UK ON USUARIOS_WEB (CPF, SENHA)
TABLESPACE MPH_IDX
PCTFREE 10
;
---------------------------------------------------------------------------------------------

REM *****************************************************************************************
REM *** SEQUENCIAS
REM *****************************************************************************************
PROMPT 
PROMPT Criando Sequencias...

CREATE SEQUENCE USUARIOS_WEB_SEQ
INCREMENT BY 1
NOMINVALUE 
NOMAXVALUE
NOCYCLE 
NOCACHE
ORDER;
  