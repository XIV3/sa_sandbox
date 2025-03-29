# List

Get a list of application domain.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/application-domains
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/application-domains" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Application Domain List
- __200__ (Ok)

``` json
{
    "applicationDomains": {
        "current_page": 1,
        "data": [
            {
                "id": 110,
                "domain": "serveravatar.test",
                "dns_propagation": 0,
                "autossl": 0,
                "created_at": "2023-02-28 23:20:53",
                "temp_domain": 1,
                "toggle_temp_domain": 1,
                "created_by_humans": "3 hours ago"
            }
        ],
        "first_page_url": "https://api.serveravatar.com/organizations/5/servers/15/applications/92/application-domains?page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "https://api.serveravatar.com/organizations/5/servers/15/applications/92/application-domains?page=1",
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "https://api.serveravatar.com/organizations/5/servers/15/applications/92/application-domains?page=1",
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
        "path": "https://api.serveravatar.com/organizations/5/servers/15/applications/92/application-domains",
        "per_page": 8,
        "prev_page_url": null,
        "to": 1,
        "total": 1
    }
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