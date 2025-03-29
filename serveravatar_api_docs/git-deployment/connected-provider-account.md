# Connected Provider's account

Use this method to get a list of connected git provider's account.

### HTTP Request:

```js
GET https://api.serveravatar.com/git-deployment/{provider}/account
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/git-deployment/gitlab/account" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Connected Provider Account
- __200__ (Ok)

``` json
{
  "provider": {
    "current_page": 1,
    "data": [
      {
        "id": 5,
        "email": "user@gmail.com"
      }
    ],
    "first_page_url": "https://api.serveravatar.com/git-deployment\/gitlab\/account?page=1",
    "from": 1,
    "next_page_url": null,
    "path": "https://api.serveravatar.com/git-deployment\/gitlab\/account",
    "per_page": 10,
    "prev_page_url": null,
    "to": 2
  }
}
```