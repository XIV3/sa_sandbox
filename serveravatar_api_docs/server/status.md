# Status

Get an installing status of the server on the account.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/status
```
### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/status" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Server Status
- __200__ (Ok)

``` json
{
  "record": [
    {
      "key": "creating_server",
      "status": "completed",
      "label": "Server Created",
      "percentage": 0
    },
    {
      "key": "inspecting",
      "status": "completed",
      "label": "Inspecting Done",
      "percentage": 0
    },
    {
      "key": "check_port",
      "status": "completed",
      "label": "Port Checked",
      "percentage": 0
    }
    ....
  ],
  "key": "finalize",
  "status": "completed",
  "configurationInPercentage": 100,
  "label": "Ready To Rock with Serveravatar 🚀",
  "server": {
    "id": 15,
    "organization_id": 5,
    "server_instance_id": 15,
    "cloud_provider_id": null,
    "provider_name": "lightsail",
    "ip": "53.21.17.517",
    "name": "alex-sites",
    "hostname": "ip-172-26-15-135",
    "operating_system": "ubuntu",
    "version": "20.04",
    "arch": "x86_64",
    "cores": 1,
    ....
  }
}
```

#### Server Not Found
- __404__ (Not Found)

```json
"message": "Server not found!"
```

#### Server Error
- __500__ (Internal Server Error)
```json
{
    "message": "Something went really wrong!"
}