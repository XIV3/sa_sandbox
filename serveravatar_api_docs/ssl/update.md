# Update

Update a custom SSL certificate.

### HTTP Request:

```js
PATCH https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/ssl
```

### Parameter:

| Parameters     | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| ssl_certificate | Yes | Text | SSL Certificate file contents. |
| private_key | Yes | Text | Private Key file contents. |
| chain_file | No | Text | Chain file contents. |

### Curl Request example:

```sh
curl --request PATCH \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/ssl" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "ssl_certificate": "-----BEGIN CERTIFICATE-----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-----END CERTIFICATE-----",
    "private_key": "-----BEGIN RSA PRIVATE KEY-----MIIEowIBAAKCAQEAs4HPc3IzSxzSL82GsVIkFUyQ5GE40Pa1YaNbUREb/3Z6uqAgxgaQmpO+QnSl7BL6Fw7nlJxW02gHKZkbhLy0LKL7b6d1zMepUcabMdEqPI7z9bB014glbKwzKf9w4VCM6QnQGFrBxALkDJ+1opVEBWRMgLi9Ap1jNHSsACsCUxPueP83NmUFZmNNlg9f8HjOC7I1C84b8en8PVbfemOwAxWfaBiF+w4D6xZwL5xFnhFpS/H2BgKfEbJAABKFtq71rVRmOtb9IvyiB8sKWrn8IDYW1wRcg6UN6CDwhz6ed4oW08SgtxsO4xSRPBTbpluBlQ9W2ztkD+UTnzX6MOwCUQIDAQABAoIBAGWrbVMm6HRvk4CtuM8wBe3mWt5vTl3UjfEKNAtbVG9BrMuNLGLcjwRuD8HWDbADI5DxySp7zhWZAw2FgXeR5b6uZRjdUTQ2FemSQo5ZuMFp+jU6x0LYAtJlSelMm6OSGu1WuH1C0iJxvLaFsruuLUOchlQVzj/v4qNwPYcu1Pc2DFS/Me0ClYa1kbXEbcGD36lhEaKdmagxuRWpKNNz6Lj1yA7gqBuvzqFtIM2DJsNvZa7B5MDM3QRI8BDyGaNNzBEzfsuz0VG8aqQHbu+F11e3ytfPvAqcpHJv9y49pwh6hE5jVlOKbkdVDSgcfwgDRZ/oJurQap5ByEHITBLmjAECgYEA5j1/ppyqkWF+u+GCJyjpCEFLQ0SJlZUdd0SqB7uIZI9kK5zjp1HDmkMyMWFmwV2qrR63PwAjGCoqt+0elwsFRdjXAH9JNu2sTa3gQ+iJzFmWnJ1S1f+nC4OR+ePpsdAj9L6HOlVvfH5NCdooHPL7vFp9MEcqPhN6l1pifB5K0ECgYEAx5c4peAiNDqqgnDDPYZeiuCASjQhjLO3QwIixEdaDjk9ZppIdOPiEKbjfiPRaE65uxD9GQ/YawDVP2aaQzwrY72wwynjQHhy4lZeefud22QolSx9xWTHLP5QMarbeikCxLArsR2/PAhVNAJydM8wx5dWPo51dE5o7cTOIRGmYxECgYEArRaswZ/j5xmpgit9gl0SG5+iqjZ7TJXmqgRX4ypL1nWqM9NlniNAEZZOAx3jXHCWDq1R9JILA32jL5qv/pEOnuiPTNs96Ri4Vq+w8vjCyb4smXCU14iWo+lH2SyvZQ1EbxuH5nZQfFTOKTQ7Ruzm8oJRSqxnFGxffwKs1gOPxEECgYAggd62FYU8oHl4+UizUpk/YUVD0K3OLs8gWM60em1xIQKBgEcLnRQkmz/1wLH+KSLQMO85X6OyWPv5zGdFIEEX2toF5M5SXJWwgcXjBDDIsrsIz6UjHxh62MsQYecTMAA5UTMa+IjP7INvfZ2OcZqczElZwouzcJ5VzcU55DGLpjKhih5g+iA9tsyM47dkWRBjCitVbLXKR0fEZ0HRCaFuyazJ-----END RSA PRIVATE KEY-----",
    "chain_file": "-----BEGIN CERTIFICATE-----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-----END CERTIFICATE-----"
  }'
```

### Response:

#### Update Custom SSL
- __200__ (Ok)

``` json
{
  "message": "SSL Certificate has been successfully updated!"
}
```

#### Available in Custom Only 
- __500__ (Internal Server Error)

```json
{
    "message": "You can not perform this action!"
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
    "message": "Application not found!"
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