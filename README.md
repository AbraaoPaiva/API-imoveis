# Sistema API de imóveis!

Olá, essa API de imóveis foi criada com objetivo de realizar um CRUD. Nela é possível realizar a criação de um novo imóvel, leitura de todos (por paginação) imóveis, vizualiar dados de um imóvel especifico, edição de um imóvel já cadastrado e remoção de um determinado imóvel. 
Ao criar um novo imóvel, o usuário recebe em seu e-mail uma nota de confirmação informando que foi cadastrado com sucesso, ou seja, utilize um e-mail válido ao realizar um criação de imóvel no sistema.


# .env

No arquivo .env localizado na raiz do projeto, favor adicionar as seguintes linhas de códigos na linha 39 para que seja possível a funcionalidade de e-mails: 

    MAIL_DRIVER=smtp MAIL_HOST=smtp.gmail.com 
    MAIL_PORT=587 		     	
    MAIL_USERNAME=abraaotestaemail93@gmail.com 
    MAIL_FROM_ADDRESS=abraaotestaemail93@gmail.com 
    MAIL_PASSWORD=teste@123456 MAIL_ENCRYPTION=tls 
    MAIL_FROM_NAME="Locação de imóveis"


Ao criar um novo imóvel é enviado o seguinte recibo no e-mail do usuário:
![enter image description here](https://i.ibb.co/NTxYnR8/1.png)

É importante também que seja feita a conexão com seu banco de dados.

## Funcionamento da API

Para funcionar é importante que tenha o composer instalado e utilizar o comando composer update. 
Após utilizar o php artisan serve para inciar o servidor PHP, use algum cliente de API. No meu caso utilizo o Insomnia. 

Funcionamento criando um imóvel para locação:
![enter image description here](https://i.ibb.co/XjcyDzN/1.png)
Campo "tipo_id" informa se o imóvel é uma casa, apartamento, sala comercial ou galpão.
Campo "negocio_id" informa se o imóvel está para locação ou venda.

Funcionamento listando imóveis:
![enter image description here](https://i.ibb.co/524DpS1/1.png)
Por padrão está fazendo uma paginação de 5 em 5 imóveis, mas o valor pode ser alterado.

Funcionalidade editando imóvel:
![enter image description here](https://i.ibb.co/z506Jrb/1.png)

Funcionalidade deletando um imóvel: 
![enter image description here](https://i.ibb.co/KxMhwVL/1.png)

Funcionalidade mostrando um imóvel especifico: 
![enter image description here](https://i.ibb.co/0DZRtb2/1.png)


## Validações de dados

Todos os dados passam por uma validação, podendo ser alterado as regras na função "regras" dentro da model.
