# DNS Records

## List

List of Cloudflare dns records.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/dns-manager/dns-records
```

### Curl request Example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/dns-manager/dns-records" \
  --header 'Content-Type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### DNS Records

- __200__ (Ok)

``` json
{
  "records": [
    {
      "id": "b14465a5dc825ef99a7a9e373c253619",
      "zone_id": "a67cfe6974229536aba57da2e7b4611c",
      "type": "A",
      "name": "testr.satest.xyz",
      "content": "3.71.4.104",
      "ttl": 1,
      "proxied": true
    },
    {
      "id": "cce7953a0965896ee3bec4615319fa1a",
      "zone_id": "a67cfe6974229536aba57da2e7b4611c",
      "type": "CNAME",
      "name": "*.satest.xyz",
      "content": "satest.xyz",
      "ttl": 1,
      "proxied": false
    }
  ],
  "result_info": {
    "page": 1,
    "per_page": 10,
    "count": 4,
    "total_count": 4,
    "total_pages": 1
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

## Create

Create DNS Records.

### HTTP Request:

```js
POST https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/dns-manager/dns-records?content=&type=&page=1
```

### Parameter:

| Parameters     | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| name | Yes | String | Your record name. |
| type | Yes | String | Select any one, A, CNAME, TXT, MX. |
| content | Yes | String | Your record content. |
| proxied | Yes | Boolean | Your record proxied, true/false. |
| ttl | Yes | String | Your record ttl. |
| priority | No | Numeric | Required if, type is MX. Priority between 0-65535. |

### Curl Request Example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/dns-manager/dns-records?content=&type=&page=1" \
  --header 'Content-Type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "content":"3.71.4.104",
    "name":"user.satest.xyz",
    "proxied":false,
    "ttl":1,
    "type":"A"
  }'
```

### Response:

#### DNS Record Create

- __200__ (Ok)

``` json
{
  "response": true,
  "message": "DNS record created successfully."
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

Update DNS Records.

### HTTP Request:

```js
PATCH https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/dns-manager/dns-records/{record}
```

### Parameter:

| Parameters     | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| name | Yes | String | Your record name. |
| type | Yes | String | Select any one, A, CNAME, TXT, MX. |
| content | Yes | String | Your record content. |
| proxied | Yes | Boolean | Your record proxied, true/false. |
| ttl | Yes | String | Your record ttl. |
| priority | No | Numeric | Required if, type is MX. Priority between 0-65535. |

### Curl Request Example:

```sh
curl --request PATCH \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/dns-manager/dns-records/cce7953a0965896ee3bec4615319fa1a" \
  --header 'Content-Type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "content":"3.71.4.104",
    "name":"test.satest.xyz",
    "proxied":false,
    "ttl":1,
    "type":"A"
  }'
```

### Response:

#### DNS Record Update

- __200__ (Ok)

``` json
{
  "response": true,
  "message": "DNS record updated successfully."
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

## Delete

Delete cloudflare details.

### HTTP Request:

```js
DELETE https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/dns-manager/dns-records/{record}
```

```sh
curl --request DELETE \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/dns-manager/dns-records/cce7953a0965896ee3bec4615319fa1a" \
  --header 'Content-Type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' 
```

### Response:

#### DNS Record Delete

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