# phpMyAdmin

Access PHPMyAdmin on the server.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/phpmyadmin
```

### Curl Request Example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/5/servers/15/phpmyadmin" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### phpMyAdmin Already Exists
- __200__ (Ok)

```json
{
  "url": "https:\/\/MXWyrK5Dkgwcj5yC.serveravatarpma.com"
}
```

#### phpMyAdmin Install
- __200__ (Ok)

```json
{
  "url": "https:\/\/MXWyrK5Dkgwcj5yC.serveravatarpma.com",
  "message": "Phpmyadmin installed successfully!"
}
```

#### Organization Not Found
- __404__ (Not Found)

```json
{
    "message":"Organization not found!"
}
```

#### Server Not Found
- __404__ (Not Found)

```json
{
    "message":"Server not found!"
}
```

#### Server Error
- __500__ (Internal Server Error)

```json
{
    "message":"Something went really wrong!"
}