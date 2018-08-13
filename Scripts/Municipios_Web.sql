PROMPT
PROMPT Deletando Objetos Antigos... [Tabelas,Indices,Constraints,Sequencias...]

DROP SEQUENCE MUNICIPIOS_WEB_SEQ;
DROP TABLE MUNICIPIOS_WEB;


REM *****************************************************************************************
REM *** CRIACAO DA TABELA DE MUNICIPIOS_WEB
REM *****************************************************************************************
PROMPT
PROMPT Criando Tabela Municipios...

CREATE TABLE MUNICIPIOS_WEB( 
CHAVE     	  	   NUMBER           	CONSTRAINT Municipios_CHAVE_NN NOT NULL,
NOME              	   VARCHAR2(40)		CONSTRAINT Municipios_NOME_NN NOT NULL,
UF		 	   VARCHAR2(2)		CONSTRAINT Municipios_UF_NN NOT NULL,
CEP			   VARCHAR2(8)		NULL
);

	

REM *****************************************************************************************
REM *** INDICES
REM *****************************************************************************************
PROMPT 
PROMPT Criando Indices...

---------------------------------------------------------------------------------------------
ALTER TABLE MUNICIPIOS_WEB ADD(CONSTRAINT MUNICIPIOS_WEB_PK PRIMARY KEY(chave))
/
alter index MUNICIPIOS_WEB_PK rebuild tablespace GESTAO_IDX;
---------------------------------------------------------------------------------------------
CREATE UNIQUE INDEX MUNICIPIOS_WEB_UK ON MUNICIPIOS_WEB (uf, nome)
TABLESPACE GESTAO_IDX
PCTFREE 10
;
---------------------------------------------------------------------------------------------
CREATE INDEX MUNICIPIOS_WEB_Nome_I ON MUNICIPIOS_WEB (nome)
TABLESPACE GESTAO_IDX
PCTFREE 10
;
---------------------------------------------------------------------------------------------

REM *****************************************************************************************
REM *** SEQUENCIAS
REM *****************************************************************************************
PROMPT 
PROMPT Criando Sequencias...

CREATE SEQUENCE MUNICIPIOS_WEB_SEQ
INCREMENT BY 1
NOMINVALUE 
NOMAXVALUE
NOCYCLE 
NOCACHE
ORDER 
;
