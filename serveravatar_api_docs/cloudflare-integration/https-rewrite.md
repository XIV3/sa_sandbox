# HTTPS Rewrite

## Get

Get the detail of cloudflare HTTPS-Rewrite.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/dns-manager/ssl/https-rewrite
```

### Curl request Example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/dns-manager/ssl/https-rewrite" \
  --header 'Content-Type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### HTTPS Rewrite

- __200__ (Ok)

``` json
{
    "response": {
        "id": "automatic_https_rewrites",
        "value": "on",
        "modified_on": "2022-06-10T06:08:55.717413Z",
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

Update the detail of cloudflare HTTPS Rewrite.

### HTTP Request:

```js
PATCH https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/dns-manager/ssl/https-rewrite/{value :on/off}
```

### Curl Request Example:

```sh
curl --request PATCH \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/dns-manager/ssl/https-rewrite/on" \
  --header 'Content-Type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' 
```

### Response:

#### Update HTTPS Rewrite

- __200__ (Ok)

``` json
{
    "response": true,
    "message": "HTTPS rewrites updated successfully."
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

