# SSL/TLS encryption

## Get

Get the detail of cloudflare SSL/TLS encryption.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/dns-manager/ssl
```

### Curl request Example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/dns-manager/ssl" \
  --header 'Content-Type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### SSL/TLS encryption

- __200__ (Ok)

``` json
{
	"response": "flexible"
}
```

#### Organization Not Found
- __404__ (Not Found)

```json
{
    "message": "Organization not found!"
}
```

#### Application Not found
- __404__ (Not Found)

```json
{
    "message": "Application not found!"
}
```

#### Server Not Found
- __404__ (Not Found)

```json
{
    "message": "Server not found!"
}
```

## Update

Update the detail of cloudflare SSL/TLS encryption.

### HTTP Request:

```js
PATCH https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/dns-manager/ssl/{value: off/flexible/full/strict}
```

### Curl Request Example:

```sh
curl --request PATCH \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/dns-manager/ssl/full" \
  --header 'Content-Type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' 
```

### Response:

#### Update SSL/TLS encryption

- __200__ (Ok)

``` json
{
	"response": true,
	"message": "Your SSL\/TLS encryption mode updated successfully."
}
```

#### Invalid Parameter(value)
- __500__ (Internal Server Error)

```json
{
    "message": "Invalid request!"
}
```

#### Organization Not Found
- __404__ (Not Found)

```json
{
    "message": "Organization not found!"
}
```

#### Application Not found
- __404__ (Not Found)

```json
{
    "message": "Application not found!"
}
```

#### Server Not Found
- __404__ (Not Found)

```json
{
    "message": "Server not found!"
}
```

