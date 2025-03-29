# Members

List of organization members.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/members?query=&page=1
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/5/members?query=&page=1" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Members
- __200__ (Ok)

``` json
{
    "members": {
        "current_page": 1,
        "data": [
            {
                "id": 10,
                "email": null,
                "designation": "Owner",
                "created_at": "2023-02-13 18:29:40",
                "updated_at": "2023-02-13 18:29:40",
                "user": {
                    "id": 3,
                    "name": "Admin",
                    "email": "admin@serveravatar.com",
                    "avatar": "https://www.gravatar.com/avatar/365364ad4392d2e9a7da889f435f9f89?d=&s=200"
                },
                "roles": [
                    {
                        "id": 13,
                        "role": "owner"
                    }
                ]
            }
        ],
        "first_page_url": "https://api.serveravatar.com/organizations/5/members?page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "https://api.serveravatar.com/organizations/5/members?page=1",
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "https://api.serveravatar.com/organizations/5/members?page=1",
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
        "path": "https://api.serveravatar.com/organizations/5/members",
        "per_page": 10,
        "prev_page_url": null,
        "to": 1,
        "total": 1
    }
}
```

#### Not Found:
- __404__ (Not found)

```json
{
  "message": "Organization not found."
}
```

#### Server Error
- __500__ (Internal Server Error)

```json
{
    "message": "Something went really wrong!"
}
```