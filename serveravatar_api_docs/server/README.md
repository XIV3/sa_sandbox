# List

Get complete detail of the connected server.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers?pagination=1
```

### Curl Request example:

```sh
curl --request GET --url "https://api.serveravatar.com/organizations/{organization}/servers?pagination=1" \
  --header 'Accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Servers List
- __200__ (Ok)

``` json
{
  "servers": {
    "current_page": 1,
    "data": [
      {
        "id": 14,
        "organization_id": 5,
        "provider_name": "lightsail",
        "ip": "53.21.17.517",
        "name": "alex-server",
        "hostname": "ip-172-26-3-160",
        "operating_system": "ubuntu",
        "version": "20.04",
        "arch": "x86_64",
        "cores": 1,
        "web_server": "nginx",
        "ssh_status": "1",
        "php_cli_version": 8,
        "database_type": "mysql",
        "ssh_port": 22,
        "agent_status": "1",
        "agent_version": "7.0",
        "php_versions": "[\"8.0\",\"8.2\",\"8.1\",\"7.4\",\"7.3\",\"7.2\"]",
        "timezone": "Asia/Kolkata",
        "root_password_authentication": "yes",
        "permit_root_login": "yes",
        "country_code": "US",
        "ols_automatically_restart": 0,
        "restart_required": 0,
        "firewall": 0,
        "nodejs": 0,
        "created_at": "2023-02-18 20:27:47",
        "updated_at": "2023-02-20 01:50:55",
        "deleted_at": null,
        "health_status": "Good",
        "health_message": "Server health is good",
        "tags": [
          "Test",
          "NewTag"
        ],
        "latest_monitor_log": {
          "id": 872,
          "load_average": 1.5,
          "memory_usage": 76.34,
          "disk_usage": 77,
          "server_load_notified": 0,
          "memory_usage_notified": 0,
          "disk_usage_notified": 0,
          "created_at": "2022-09-13 22:00:04",
          "updated_at": "2023-02-24 02:56:37"
        }
      }
    ],
    "first_page_url": "https://api.serveravatar.com/organizations/5/servers?pagination=1&page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "https://api.serveravatar.com/organizations/5/servers?pagination=1&page=1",
    "links": [
      {
        "url": null,
        "label": "&laquo; Previous",
        "active": false
      },
      {
        "url": "https://api.serveravatar.com/organizations/5/servers?pagination=1&page=1",
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
    "path": "https://api.serveravatar.com/organizations/5/servers",
    "per_page": 12,
    "prev_page_url": null,
    "to": 1,
    "total": 1
  }
}
```

#### Organization Not Found
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
    "message": "Something went really wrong while loading servers."
}
```