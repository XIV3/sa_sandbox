# Destroy

Delete the application domain. Note that you can't retrive it back once you delete it.

### HTTP Request:

```js
DELETE https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/application-domains/{application_domain}
```

### Curl Request Example:

```sh
curl --request DELETE \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/application-domains/{application_domain}" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Application Domain Deleted sucessfully
- __200__ (Ok)

```json
{
    "message": "Application domain deleted successfully."
}
```

#### Application Primary Domain Detected
- __500__ (Internal Server Error)

```json
{
    "message": "Primary domain cannot be deleted."
}
```

#### Application Domain Not Found
- __404__ (Not Found)

```json
{
    "message": "Application Domain not found!"
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