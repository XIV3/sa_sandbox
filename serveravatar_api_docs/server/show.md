# Show

Get a detail of particular server of the account.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}
```

### Curl Request Example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Server Show
- __200__ (Ok)

``` json
{
  "server": {
    "id": 12,
    "organization_id": 1,
    "provider_name": "lightsail",
    "ip": "53.21.17.517",
    "name": "alex-sites",
    "hostname": "ip-172-26-15-135",
    "operating_system": "ubuntu",
    "version": "20.04",
    "arch": "x86_64",
    "cores": 1,
    "web_server": "nginx",
    "ssh_status": "1",
    "php_cli_version": "8.0",
    "database_type": "mariadb",
    "redis_password": "FS6W3xn10YHPB1Ex....",
    "ssh_port": 22,
    "phpmyadmin_slug": null,
    "filemanager_slug": null,
    "agent_status": "1",
    "agent_version": "7.0",
    "php_versions": [
      "8.0",
      "8.2",
      "8.1",
      "7.4",
      "7.3",
      "7.2"
    ],
    "timezone": "Etc\/UTC",
    .....
  }
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