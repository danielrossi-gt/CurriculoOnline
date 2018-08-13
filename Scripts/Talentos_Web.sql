PROMPT
PROMPT Deletando Objetos Antigos... [Tabelas,Indices,Constraints,Sequencias...]

DROP SEQUENCE TALENTOS_WEB_SEQ;
DROP TABLE TALENTOS_WEB;


REM *****************************************************************************************
REM *** CRIACAO DA TABELA DE TALENTOS_WEB (CURRICULUM)
REM *****************************************************************************************
PROMPT
PROMPT Criando Tabela TALENTOS_WEB...

CREATE TABLE TALENTOS_WEB (
CHAVE                   	NUMBER           	NOT NULL,
CODIGO_BASE			NUMBER			NOT NULL,
CHAVE_USUARIO_WEB		NUMBER			NOT NULL,
CPF				VARCHAR2(11)		NULL,
NUMERO_RG			VARCHAR2(12)		NULL,
NOME		      		VARCHAR2(50)		NOT NULL,
ENDERECO			VARCHAR2(40)            NULL,
NUMERO   			VARCHAR2(6)             NULL,
COMPLEMENTO			VARCHAR2(20)            NULL,
BAIRRO  			VARCHAR2(30)            NULL,
CIDADE  			NUMBER                  NULL,
CEP				VARCHAR2(08)            NULL,
TELEFONE			VARCHAR2(15)		NULL,
TELEFONE_CELULAR		VARCHAR2(15)		NULL,
EMAIL				VARCHAR2(50)		NULL,
DATA_NASCIMENTO			DATE			NULL,
NACIONALIDADE			VARCHAR2(30)		NULL,
SEXO				VARCHAR2(10)		NULL,
ESTADO_CIVIL			VARCHAR2(15)		NULL,
PORTADOR_DEFICIENCIA		VARCHAR2(03)		NULL,
TIPO_CARGO			NUMBER			NULL,    
DATA_CADASTRO			DATE			NOT NULL);
-----------------------------------------------------------------


REM *****************************************************************************************
REM *** INDICES
REM *****************************************************************************************
PROMPT 
PROMPT Criando Indices...

ALTER TABLE TALENTOS_WEB ADD(CONSTRAINT TALENTOS_WEB_PK PRIMARY KEY(CHAVE, CODIGO_BASE))
/
alter index TALENTOS_WEB_PK rebuild tablespace GESTAO_IDX;
---------------------------------------------------------------------------------------------

REM *****************************************************************************************
REM *** SEQUENCIAS
REM *****************************************************************************************
PROMPT 
PROMPT Criando Sequencias...

CREATE SEQUENCE TALENTOS_WEB_SEQ
INCREMENT BY 1
NOMINVALUE 
NOMAXVALUE
NOCYCLE 
NOCACHE
ORDER 
;

