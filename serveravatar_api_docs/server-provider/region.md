# Region

Get regions of the connected cloud service provider.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/cloud-server-providers/{cloudServerProvider}/regions
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/cloud-server-providers/{cloudServerProvider}/regions" \
  --header 'Accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

- __200__ (Ok)

``` json
[
  {
    "name": "Virginia",
    "country_code": "US",
    "value": "us-east-1",
    "available": true
  },
  {
    "name": "Ohio",
    "country_code": "US",
    "value": "us-east-2",
    "available": true
  },
  {
    "name": "Oregon",
    "country_code": "US",
    "value": "us-west-2",
    "available": true
  }
  ....
]
```

#### Organization Not Found
- __404__ (Not Found)

```json
{
  "message": "Organization not found!"
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

## Availability Zone For Amazon Lightsail

Get Availability Zone of the Lightsail cloud service provider.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/cloud-server-providers/{cloudServerProvider}/regions?region=ap-south-1
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/cloud-server-providers/{cloudServerProvider}/regions?region=ap-south-1" \
  --header 'Accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

- __200__ (Ok)

``` json
{
  "region_zones": [
    {
      "zoneName": "ap-south-1a",
      "state": "available"
    },
    {
      "zoneName": "ap-south-1b",
      "state": "available"
    },
    {
      "zoneName": "ap-south-1c",
      "state": "available"
    }
  ],
  "region": "ap-south-1",
  "sizes": null
}
```

#### Organization Not Found
- __404__ (Not Found)

```json
{
    "message": "Organization not found!"
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