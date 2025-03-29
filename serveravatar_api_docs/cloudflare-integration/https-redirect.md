# HTTPS Redirect

## Get

Get the detail of cloudflare HTTPS Redirect.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/dns-manager/ssl/https-redirect
```

### Curl request Example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/dns-manager/ssl/https-redirect" \
  --header 'Content-Type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### HTTPS Redirect

- __200__ (Ok)

``` json
{
    "response": {
        "id": "always_use_https",
        "value": "on",
        "modified_on": "2022-06-10T06:08:00.692315Z",
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

Update the detail of cloudflare HTTPS Redirect.

### HTTP Request:

```js
PATCH https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/dns-manager/ssl/https-redirect/{value :on/off}
```

### Curl Request Example:

```sh
curl --request PATCH \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/dns-manager/ssl/https-redirect/on" \
  --header 'Content-Type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' 
```

### Response:

#### Update HTTPS-Redirect

- __200__ (Ok)

``` json
{
    "response": true,
    "message": "HTTPS redirect updated successfully."
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

