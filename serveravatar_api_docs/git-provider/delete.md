# Delete

Delete connected git provider account.

### HTTP Request:

```js
DELETE https://api.serveravatar.com/organizations/{organization}/git-providers/{provider_id}
```

### Curl Request example:

```sh
curl --request DELETE \
  --url "https://api.serveravatar.com/organizations/5/git-providers/3" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Provider Delete
- __200__ (Ok)

``` json
{
    "message":"Your bitbucket provider successfully disconnected."
}
```

#### Organization Not Found
- __404__ (Not Found)

```json
{
    "message": "Organization not found!"
}
```

#### Provider Not Found
- __404__ (Not Found)

```json
{
    "message": "Git Provider not found!"
}
```

#### Server Error
- __500__ (Internal Server Error)
```json
{
    "message": "Something went really wrong!"
}
```