# TLS 1.3

## Get

Get the detail of cloudflare TLS 1.3.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/dns-manager/ssl/tls-13
```

### Curl request Example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/dns-manager/ssl/tls-13" \
  --header 'Content-Type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### TLS 1.3

- __200__ (Ok)

``` json
{
    "response": {
        "id": "tls_1_3",
        "value": "on",
        "modified_on": null,
        "editable": true
    }
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

Update the detail of cloudflare TLS 1.3.

### HTTP Request:

```js
PATCH https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/dns-manager/ssl/tls-13/{value: on, off}
```

### Curl Request Example:

```sh
curl --request PATCH \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/dns-manager/ssl/tls-13/on" \
  --header 'Content-Type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' 
```

### Response:

#### Update TLS 1.3

- __200__ (Ok)

``` json
{
    "response": true,
    "message": "TLS 1.3 updated successfully."
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

