# Change Primary Domain

Change primary domain of the application. you can't change the primary domain of the application if you don't Created another domain in that application.

### HTTP Request:

```js
PATCH https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/application-domains/{application_domain}
```

### Parameter:

| Parameters     | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| is_wordpress_url_update | Yes | Boolean | `true`, If application type is wordpress. |
| forceHttps | No | Boolean | `true`, If you want to force https while `is_wordpress_url_update` is `true`. |

### Curl Request Example:

```sh
curl --request PATCH \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/application-domains/{application_domain}" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "is_wordpress_url_update": 0
  }'
```

### Response:

#### Application Primary Domain Change
- __200__ (Ok)

``` json
{
  "primary_domain": "test.siteexample.tk",
  "message": "Primary domain changed successfully."
}
```

#### Application Domain Not Found
- __404__ (Not Found)

```json
{
    "message": "Application domain not found!"
}
```

#### Organization Not Found
- __404__ (Not Found)

```json
{
    "message": "Organization not found!"
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