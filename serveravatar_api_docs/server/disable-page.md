# Disable Page

## Get

Get a detail of web server's application disable-page.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/web-page?disabled=true
```

### Curl Request Example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/web-page?disabled=true" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Web Page
- __200__ (Ok)

``` json
{
  "web_page": "<html lang=\"en\">\n<head>\n  <meta charset=\"utf-8\">\n  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n\n  <title>This site is disabled!</title>\n\n    <link href=\"https://fonts.googleapis.com/css?family=Source+Code+Pro\" rel=\"stylesheet\">\n\t<style>\n\t\thtml{\n\t\t\tfont-family: 'Source Code Pro', monospace;\n            background: #333333;\n\t\t}\n\t\t\n\t\th1,h5{\n\t\t    color:#ffffff;\n\t\t}\n\t\t\n\t\t.html, body {\n    height: 100%;\n}\n\nbody{\n\tmargin: 0;\n}\n\n.parent {\n    width: 100%;\n    height: 100%;\n    display: table;\n    text-align: center;\n}\n.parent > .child {\n    display: table-cell;\n    vertical-align: middle;\n}\n\nimg{\n    max-width: 100%; \ndisplay: block; \nheight: auto;\nmargin:0 auto;\n}\n\t</style>\n</head>\n\n<body>\n    <section class=\"parent\">\n        <div class=\"child\">\n            <img width=\"250px\" src=\"https://serveravatar.com/wp-content/uploads/2023/04/ServerAvatar-Logo-Horizontal-02.png\">\n        <h1>This site is disabled!</h1>\n        <h5>If you are the owner of the site, You can enable it from the ServerAvatar dashboard.</h5>\n    </div>\n    </section>\n</body>\n</html>"
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

Update a detail of web server's application default-page.

### HTTP Request:

```js
POST https://api.serveravatar.com/organizations/{organization}/servers/{server}/web-page?disabled=true
```

### Curl Request Example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/web-page?disabled=true" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
      "body": "<html lang=\"en\">\n<head>\n  <meta charset=\"utf-8\">\n  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n\n  <title>This site is disabled!</title>\n\n    <link href=\"https://fonts.googleapis.com/css?family=Source+Code+Pro\" rel=\"stylesheet\">\n\t<style>\n\t\thtml{\n\t\t\tfont-family: 'Source Code Pro', monospace;\n            background: #333333;\n\t\t}\n\t\t\n\t\th1,h5{\n\t\t    color:#ffffff;\n\t\t}\n\t\t\n\t\t.html, body {\n    height: 100%;\n}\n\nbody{\n\tmargin: 0;\n}\n\n.parent {\n    width: 100%;\n    height: 100%;\n    display: table;\n    text-align: center;\n}\n.parent > .child {\n    display: table-cell;\n    vertical-align: middle;\n}\n\nimg{\n    max-width: 100%; \ndisplay: block; \nheight: auto;\nmargin:0 auto;\n}\n\t</style>\n</head>\n\n<body>\n    <section class=\"parent\">\n        <div class=\"child\">\n            <img width=\"250px\" src=\"https://serveravatar.com/wp-content/uploads/2023/04/ServerAvatar-Logo-Horizontal-02.png\">\n        <h1>This site is disabled!</h1>\n        <h5>If you are the owner of the site, You can enable it from the ServerAvatar dashboard.</h5>\n    </div>\n    </section>\n</body>\n</html>"
  }'
```

### Response:

#### Web Page
- __200__ (Ok)

``` json
{
  "message": "Default disable web page has been updated successfully."
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