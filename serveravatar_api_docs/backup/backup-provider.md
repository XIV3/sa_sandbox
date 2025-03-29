# List

Get a cloud storage providers.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/cloud-storage-providers?pagination=1
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/5/cloud-storage-providers?pagination=1" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Cloud Storage Provider:

- __200__ (Ok)

```json
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "name": "",
            "provider": "gdrive",
            "email": "user@gmail.com"
        }
    ],
    "first_page_url": "https://api.serveravatar.com/organizations/5/cloud-storage-providers?pagination=1&page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "https://api.serveravatar.com/organizations/5/cloud-storage-providers?pagination=1&page=1",
    "links": [
        {
            "url": null,
            "label": "&laquo; Previous",
            "active": false
        },
        {
            "url": "https://api.serveravatar.com/organizations/5/cloud-storage-providers?pagination=1&page=1",
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
    "path": "https://api.serveravatar.com/organizations/5/cloud-storage-providers",
    "per_page": 8,
    "prev_page_url": null,
    "to": 2,
    "total": 2
}
```

#### Organization Not Found
- __404__ (Not Found)

```json
{
    "message": "Organization not found!"
}
```