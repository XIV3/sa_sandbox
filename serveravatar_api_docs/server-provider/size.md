# Instance Size

Get an instance size of the server.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/cloud-server-providers/{cloudServerProvider}/sizes?region={region}
```

### Curl Request Example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/cloud-server-providers/{cloudServerProvider}/sizes?region={region}" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

- __200__ (Ok)

``` json
{
  "sizes": [
    {
      "name": "Nano",
      "list": [
        {
          "name": "Nano",
          "slug": "nano_2_1",
          "ram_size_in_mb": "512",
          "cpu_core": "1",
          "disk_size_in_gb": "20",
          "price": 3.5
        }
      ]
    },
    {
      "name": "Micro",
      "list": [
        {
          "name": "Micro",
          "slug": "micro_2_1",
          "ram_size_in_mb": "1024",
          "cpu_core": "1",
          "disk_size_in_gb": "40",
          "price": 5
        }
      ]
    },
    .....
  ],
  "region": "ap-south-1"
}
```

#### Server Provider Not Found
- __404__ (Not Found)

```json
{
    "message": "Server Provider not found!"
}
```

#### Server Error
- __500__ (Internal Server Error)
```json
{
    "message": "Something went really wrong!"
} 
```