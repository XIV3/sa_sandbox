# Enabled/Disabled 

Enable or disable application domain. you can't disable the primary domain of the application if you don't add another domain on that application.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/application-domains/{application_domain}/edit
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/application-domains/{application_domain}/edit" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Enabled Domain
- __200__ (Ok)

``` json
{
  "message": "Temporary domain successfully run to rock!"
}
```

#### Disabled Domain
- __200__ (Ok)

``` json
{
  "message": "Temporary domain successfully disabled!"
}
```

#### Application Domain Not found
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

#### Domain Not Match 
- __500__ (Internal Server Error)

```json
{
    "message": "Temporary domain does not match!"
}
```

#### Server Error
- __500__ (Internal Server Error)

```json
{
    "message": "Something went really wrong!"
}
```