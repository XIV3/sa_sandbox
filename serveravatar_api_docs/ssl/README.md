# Install

Install SSL certificate on the application. Updating SSL certificate is required after adding a new domain to the application.

### HTTP Request:

```js
POST https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/ssl
```

### Parameter:
| Parameters     | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| ssl_type | Yes | String | SSL type: `automatic` or `custom` |
| ssl_certificate | No | Text | SSL Certificate file contents in plain text, if ssl_type is `custom` |
| private_key | No | Text | Private Key file contents in plain text, if ssl_type is `custom` |
| chain_file | No | Text | Chain file content. |
| force_https | Yes | Boolean | Set `true` if you want to force https redirect. |

### Curl Request example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/5/servers/15/applications/92/ssl" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "ssl_type": "automatic",
    "force_https": false
  }'
```

### Response:

#### SSL Install
- __200__ (Ok)

``` json
{
  "message": "SSL Certificate has been successfully installed on this application!"
}
```

#### Organization Not Found
- __404__ (Not Found)

```json
{
    "message": "Organization not found!"
}
```

#### DNS Propagation Check
- __500__ (Internal Server Error)

```json
{
    "message": "Please wait while the DNS propagation is done."
}
```

#### SSL Already installed
- __500__ (Internal Server Error)

```json
{
    "message": "SSL is already installed on this application."
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
```