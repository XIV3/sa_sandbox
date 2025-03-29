# List

Get a list of connected git provider accounts.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/git-providers?type={search by provider}&search={search by email}
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/5/git-providers?type=&search=" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Provider Account Lists
- __200__ (Ok)

``` json
{
    "current_page": 1,
    "data": [
        {
            "id": 3,
            "provider": "bitbucket",
            "email": "admin@serveravatar.com"
        },
        {
            "id": 4,
            "provider": "gitlab",
            "email": "admin@serveravatar.com"
        },
        {
            "id": 5,
            "provider": "github",
            "email": "admin@serveravatar.com"
        }
    ],
    "first_page_url": "https://api.serveravatar.com/organizations/5/git-providers?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "https://api.serveravatar.com/organizations/5/git-providers?page=1",
    "links": [
        {
            "url": null,
            "label": "&laquo; Previous",
            "active": false
        },
        {
            "url": "https://api.serveravatar.com/organizations/5/git-providers?page=1",
            "label": "1",
            "active": true
        },
        {
            "url": null,
            "label": "Next &raquo;",
            "active": false
        }
    ],
    "next_page_url": null,
    "path": "https://api.serveravatar.com/organizations/5/git-providers",
    "per_page": 8,
    "prev_page_url": null,
    "to": 5,
    "total": 5
}
```

#### Organization Not Found
- __404__ (Not Found)

```json
{
    "message": "Organization not found!"
}
```