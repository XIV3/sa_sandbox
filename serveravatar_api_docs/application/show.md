# Show

Get the detail of the application.

### Endpoint:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}
```

### Curl Request Example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Application Show
- __200__ (Ok)

``` json
{
    "application": {
        "id": 93,
        "framework": "wordpress",
        "name": "TestClone",
        "primary_domain": "hrtv0g.serveravatarfm.host",
        "webroot": null,
        "php_version": "8.0",
        "pm_type": "ondemand",
        "pm_max_children": 20,
        "pm_start_servers": 2,
        "pm_min_spare_servers": 1,
        "pm_max_spare_servers": 3,
        "pm_process_idle_timeout": 30,
        "pm_max_requests": 500,
        "pm_max_spawn_rate": 1,
        "max_execution_time": 60,
        "max_input_time": 60,
        "max_input_vars": 1600,
        "memory_limit": "256M",
        "post_max_size": "128M",
        "upload_max_filesize": "128M",
        "...."
    },
    "gitDeployment": null,
    "server": {
      "...."
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
    "message":"Application not found!"
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