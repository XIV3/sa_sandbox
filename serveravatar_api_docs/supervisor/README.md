# List

Get the list of application's supervisor


### HTTP Request:

```
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/supervisors
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/supervisors" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Supervisor List:

- __200__ (Ok)

```json
{
    "supervisors": {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "name": "EmailDefault",
                "user": "x5Ov6RGvBOEKVjay",
                "command": "php /home/x5Ov6RGvBOEKVjay/myapp/public_html/artisan queue:work --queue=email-worker",
                "autostart": 1,
                "autorestart": 1,
                "numprocs": 2,
                "logfile": "email-worker.log",
                "loglevel": "trace",
                "created_at": "2023-03-01 21:27:34",
                "updated_at": "2023-03-01 21:27:34"
            }
        ],
        "first_page_url": "https://api.serveravatar.com/organizations/1/servers/12/applications/5/supervisors?page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "https://api.serveravatar.com/organizations/1/servers/12/applications/5/supervisors?page=1",
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "https://api.serveravatar.com/organizations/1/servers/12/applications/5/supervisors?page=1",
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
        "path": "https://api.serveravatar.com/organizations/1/servers/12/applications/5/supervisors",
        "per_page": 10,
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