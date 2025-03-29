# Connected Git Provider

Use this method to get a list of connected git providers.

### HTTP Request:

```js
GET https://api.serveravatar.com/git-deployment/user/provider
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/git-deployment/user/provider" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Connected Provider Lists
- __200__ (Ok)

``` json
{
  "provider": [
    "gitlab",
    "github",
    "bitbucket"
  ]
}
```