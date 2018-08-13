PROMPT
PROMPT Deletando Objetos Antigos... [Tabelas,Indices,Constraints,Sequencias...]

DROP SEQUENCE TIPO_CARGO_WEB_SEQ;
DROP TABLE TIPO_CARGO_WEB;


REM *****************************************************************************************
REM *** CRIACAO DA TABELA DE Tipo_Cargo 
REM *****************************************************************************************
PROMPT
PROMPT Criando Tabela TIPO_CARGO_WEB...

CREATE TABLE TIPO_CARGO_WEB(
CHAVE                   	NUMBER           	NOT NULL,
CODIGO_BASE			NUMBER			NOT NULL,
CODIGO         			VARCHAR2(6)		NOT NULL,
DESCRICAO		      	VARCHAR2(50)		NOT NULL);

REM *****************************************************************************************
REM *** INDICES
REM *****************************************************************************************
PROMPT 
PROMPT Criando Indices...

ALTER TABLE TIPO_CARGO_WEB ADD(CONSTRAINT TIPO_CARGO_WEB_PK PRIMARY KEY(CHAVE, CODIGO_BASE))
/
ALTER INDEX TIPO_CARGO_WEB_PK REBUILD TABLESPACE GESTAO_IDX;
---------------------------------------------------------------------------------------------
CREATE UNIQUE INDEX TIPO_CARGO_WEB_UK ON TIPO_CARGO_WEB (CODIGO_BASE, CODIGO, DESCRICAO)
TABLESPACE MPH_IDX
PCTFREE 10
;
---------------------------------------------------------------------------------------------

REM *****************************************************************************************
REM *** SEQUENCIAS
REM *****************************************************************************************
PROMPT 
PROMPT Criando Sequencias...

CREATE SEQUENCE TIPO_CARGO_WEB_SEQ
INCREMENT BY 1
NOMINVALUE 
NOMAXVALUE
NOCYCLE 
NOCACHE
ORDER;