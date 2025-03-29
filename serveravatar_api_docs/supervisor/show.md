# Show

To show a supervisor.

### HTTP Request:

```
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/supervisors/{supervisor}
```

### Curl Request Example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/supervisors/{supervisor}" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
```

### Response:

#### Supervisor Show:
- __200__ (Ok)

```json
{
  "supervisor": {
    "id": 1,
    "name": "EmailDefault",
    "user": "x5Ov6RGvBOEKVjay",
    "command": "php /home/x5Ov6RGvBOEKVjay/myapp/public_html/artisan queue:work --queue=EmailHigh",
    "autostart": 1,
    "autorestart": 1,
    "numprocs": 2,
    "logfile": "EmailDefault-worker.log",
    "loglevel": "trace",
    "created_at": "2023-03-01 21:27:34",
    "updated_at": "2023-03-01 21:27:34"
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