# Connected Provider's account

Use this method to get a list of connected cloud service provider's account.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/cloud-server-providers?pagination=1&provider={search by provider}&search={search by email}
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/cloud-server-providers?pagination=1&provider=&search=" \
  --header 'Accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

- __200__ (Ok)

``` json
{
    "current_page": 1,
    "data": [
        {
            "id": 3,
            "name": "lightsail",
            "provider": "lightsail"
        }
    ],
    "first_page_url": "https://api.serveravatar.com/organizations/5/cloud-server-providers?pagination=1&page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "https://api.serveravatar.com/organizations/5/cloud-server-providers?pagination=1&page=1",
    "links": [
        {
            "url": null,
            "label": "&laquo; Previous",
            "active": false
        },
        {
            "url": "https://api.serveravatar.com/organizations/5/cloud-server-providers?pagination=1&page=1",
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
    "path": "https://api.serveravatar.com/organizations/5/cloud-server-providers",
    "per_page": 8,
    "prev_page_url": null,
    "to": 1,
    "total": 1
}
```