select USUARIOS_WEB.*, utl_raw.cast_to_varchar2(utl_encode.base64_decode(utl_raw.cast_to_raw(SENHA))) from USUARIOS_WEB WHERE CPF = '442.021.108-38'