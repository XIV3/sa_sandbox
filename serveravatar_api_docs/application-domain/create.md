# Create

Add a new application domain for the application.


### HTTP Request:

```js
POST https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/application-domains
```

### Parameter:

| Parameters     | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| domain | Yes | String | Additional domain/subdomain for your application. |

### Curl Request Example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/application-domains" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "domain" : "test.siteexample.tk"
  }'
```

### Response:

#### Application Domain Create
**200** (Ok)

```json
{
  "message": "Domain has been successfully added.",
  "application_domain": {
        "id": 131,
        "application_id": 110,
        "domain": "test.siteexample.tk",
        "dns_propagation": 0,
        "autossl": 0,
        "created_at": "2023-03-20 17:15:38",
        "updated_at": "2023-03-20 17:15:38"
    }
}
```

#### Duplicate Domain
- __500__ (Internal Server Error)
```json
{
    "message": "Duplicate domain name found for this server."
}
```

#### Organization Not Found
- __404__ (Not Found)

```json
{
    "message": "Organization not found!"
}
```

#### Application Not Found
- __404__ (Not Found)

```json
{
    "message": "Application not found!"
}
```

#### ServerAvatar Test Domain
- __500__ (Internal Server Error)

```json
{
    "message": "You can not add additional ServerAvatar Test domain in application domains section."
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