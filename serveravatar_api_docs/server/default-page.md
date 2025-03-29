# Default Page

## Get

Get a detail of web server default-page.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/web-page
```

### Curl Request Example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/web-page" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Web Page
- __200__ (Ok)

``` json
{
  "web_page": "<html>\n\t<head>\n\t\t<title>Proudly Managed By ServerAvatar</title>\n\t\t<link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>\n\t\t<style>\n\t\t\tbody {\n\t\t\t\tmargin: 0;\n\t\t\t\tpadding: 0;\n\t\t\t\twidth: 100%;\n\t\t\t\theight: 100%;\n\t\t\t\tcolor: #B0BEC5;\n\t\t\t\tdisplay: table;\n\t\t\t\tfont-weight: 100;\n\t\t\t\tfont-family: 'Lato';\n\t\t\t}\n\n\t\t\t.container {\n\t\t\t\ttext-align: center;\n\t\t\t\tdisplay: table-cell;\n\t\t\t\tvertical-align: middle;\n\t\t\t}\n\n\t\t\t.content {\n\t\t\t\ttext-align: center;\n\t\t\t\tdisplay: inline-block;\n\t\t\t}\n\n\t\t\t.message {\n\t\t\t\tfont-size: 80px;\n\t\t\t\tmargin-bottom: 40px;\n\t\t\t}\n\n\t\t\ta\n\t\t\t{\n\t\t\t\ttext-decoration : none;\n\t\t\t\tcolor : #3498db;\n\t\t\t}\n\t\t</style>\n\t</head>\n\t<body>\n\t\t<div class=\"container\">\n\t\t\t<div class=\"content\">\n\t\t\t\t<div class=\"message\">Proudly managed by <a href=\"http://www.serveravatar.com/\">ServerAvatar</a></div>\n\t\t\t</div>\n\t\t</div>\n\t</body>\n</html>\n"
}

```

#### Server Not Found
- __404__ (Not Found)

```json
{
    "message": "Server not found!"
}
```

#### Server Error
- __500__ (Internal Server Error)

```json
{
    "message": "Something went really wrong!"
}

```

## Update

Update a detail of web server default-page.

### HTTP Request:

```js
POST https://api.serveravatar.com/organizations/{organization}/servers/{server}/web-page
```

### Curl Request Example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/web-page" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
      "body": "<html>\n\t<head>\n\t\t<title>Proudly Managed By ServerAvatar</title>\n\t\t<link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>\n\t\t<style>\n\t\t\tbody {\n\t\t\t\tmargin: 0;\n\t\t\t\tpadding: 0;\n\t\t\t\twidth: 100%;\n\t\t\t\theight: 100%;\n\t\t\t\tcolor: #B0BEC5;\n\t\t\t\tdisplay: table;\n\t\t\t\tfont-weight: 100;\n\t\t\t\tfont-family: 'Lato';\n\t\t\t}\n\n\t\t\t.container {\n\t\t\t\ttext-align: center;\n\t\t\t\tdisplay: table-cell;\n\t\t\t\tvertical-align: middle;\n\t\t\t}\n\n\t\t\t.content {\n\t\t\t\ttext-align: center;\n\t\t\t\tdisplay: inline-block;\n\t\t\t}\n\n\t\t\t.message {\n\t\t\t\tfont-size: 80px;\n\t\t\t\tmargin-bottom: 40px;\n\t\t\t}\n\n\t\t\ta\n\t\t\t{\n\t\t\t\ttext-decoration : none;\n\t\t\t\tcolor : #3498db;\n\t\t\t}\n\t\t</style>\n\t</head>\n\t<body>\n\t\t<div class=\"container\">\n\t\t\t<div class=\"content\">\n\t\t\t\t<div class=\"message\">Proudly managed by <a href=\"http://www.serveravatar.com/\">ServerAvatar</a></div>\n\t\t\t</div>\n\t\t</div>\n\t</body>\n</html>\n"
  }'
```

### Response:

#### Web Page
- __200__ (Ok)

``` json
{
  "message": "Default web page has been updated successfully."
}

```

#### Server Not Found
- __404__ (Not Found)

```json
{
    "message": "Server not found!"
}
```

#### Server Error
- __500__ (Internal Server Error)
```json
{
    "message": "Something went really wrong!"
}
```