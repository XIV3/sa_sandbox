# Settings

## Show

Get the detail of Cloudflare integration.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/dns-manager
```

### Curl request Example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/dns-manager" \
  --header 'Content-Type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Cloudflare detail.

- __200__ (Ok)

``` json
{
  "dnsManager": {
    "id": 7,
    "token": "xS--5TvONWoAFCLZLfvBF0cwfiw-ncesHEpI9",
    "domain_id": "a67cfe94229536aba57da2e7b4611c"
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

Update Cloudflare details.

### HTTP Request:

```js
PATCH https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/dns-manager
```

### Parameter:

| Parameters     | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| bearerToken | Yes | String | Your cloudflare bearer token. |
| domainId | Yes | String | Your cloudflare zone id. |

### Curl Request Example:

```sh
curl --request PATCH \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/dns-manager" \
  --header 'Content-Type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "bearerToken": "xS--5TvONWoAFCLZLfvBF0cwfiw-ncesHEpI9",
    "domainId": "a67cfe94229536aba57da2e7b4611c"
  }'
```

### Response:

#### Update cloudflare detail.

- __200__ (Ok)

``` json
{
  "message": "DNS Manager credentials updated successfully."
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

#### Server Error
- __500__ (Internal Server Error)
```json
{
    "message": "Something went really wrong!"
}
```

## Delete

Delete cloudflare detail.

### HTTP Request:

```js
DELETE https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/dns-manager
```

```sh
curl --request DELETE \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/dns-manager" \
  --header 'Content-Type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' 
```

### Response:

#### Delete cloudflare detail.

- __200__ (Ok)

``` json
{
	"message":"DNS Manager credentials remove successfully."
}
```

#### Record Not found
- __404__ (Not Found)

```json
{
    "message": "Cloudflare record not found!"
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

#### Server Error
- __500__ (Internal Server Error)
```json
{
    "message": "Something went really wrong!"
}
```