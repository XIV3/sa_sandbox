# Create

Connect a new server inside the organization.

### HTTP Request:

```js
POST https://api.serveravatar.com/organizations/{organization}/direct-installation/generate-command
```

### Custom Parameters:

| parameters | Required | Type      | Description      |
|:------------- |:--------------- |:-------------- |:----------------|
| name | Yes | String | Name of the Server. |
| web_server | Yes | String | Select any one web server `apache2`, `nginx`, `openlitespeed` or `mern`. |
| database_type | Yes | String | Select any one database type `mysql`, `mariadb` or `mongodb`. |
| nodejs | Yes | Boolean | Set `1` if you want to install Node.js on the Server. |
| yarn | No | Boolean | Set `1` if you want to install Yarn on `mern` web server. |
| root_password_available | Yes | Boolean | Set `1` if you have root and password. |
| ip | No | String | Required if, `root_password_available` is `1` |
| ssh_port | No | Numeric | Required if, `root_password_available` is `1` |
| root_password | No | String | Required if, `root_password_available` is `1` |
| forceCleanup | No | Boolean | Set `1` for clean up your server. |

## Direct Installation

Connect a custom server with root password.

### Curl Request example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/{organization}/direct-installation/generate-command" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "name": "alex-sites",
    "web_server": "nginx",
    "database_type": "mysql",
    "nodejs": 0,
    "root_password_available": 0
  }'
```

### Response:

- __200__ (Ok)

```json
{
    "commands": "sudo wget https://api.serveravatar.com/direct_install; chmod +x direct_install; ./direct_install --webServer nginx --name alex-sites --database mysql --nodejs 0 --key eyJpdiI6IkJvaUFMM3UyV040Q2xSSVJnRFIxQXc9PSIsInZhbHVlIjoibFhBejBGQ21XY21...."
}
```

## Using Server Provider

Connect a server using Amazon Lightsail, DigitalOcean, Vultr, Linode, or Hetzner server provider.

### Parameters:

| parameters | Required | Type      | Description      |
|:------------- |:--------------- |:-------------- |:-------------|
| name | Yes | String | Name of the Server. |
| provider | Yes | String | Select any one  provider `lightsail`, `linode`, `hetzner`, `vultr`, or `digitalocean` |
| cloud_server_provider_id | Yes | Numeric | Select provider account. |
| version | Yes | String | Select any one version 20, 22 or 24. |
| region | Yes | String | Select region. |
| availabilityZone | No | String | Required, if provider is `lightsail`. |
| sizeSlug | Yes | String | Select size-slug. Type must be numeric when provider is `hetzner` |
| ssh_key | Yes | Boolean | True, if you have your own ssh-key. |
| public_key | No | String | Required, if ssh_key is True. |
| web_server | Yes | String | Select any one web server `apache2`, `nginx`, `openlitespeed` or `mern`. |
| database_type | Yes | String | Select any one database type `mysql`, `mariadb` or `mongodb`. |
| nodejs | Yes | boolean | Set `true` if you want to install Node.js on the Server. |
| yarn | No | Boolean | Set `true` if you want to install Yarn on `mern` web server. |
| linode_root_password | No | String | Required, if provider is `linode`. Password must be Uppercase, Lowercase, Number and Special Character. |

### HTTP Request:

```js
POST https://api.serveravatar.com/organizations/{organization}/servers
```

### Curl Request example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/{organization}/servers" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "name": "alex-sites",
    "provider": "lightsail",
    "cloud_server_provider_id": 21,
    "version": 20,
    "region": "us-east-1",
    "availabilityZone": "us-east-1a",
    "sizeSlug": "nano_2_0",
    "ssh_key": 1,
    "public_key": "{Your SSH Key}",
    "web_server": "apache2",
    "database_type": "mysql",
    "nodejs": false
  }'
```

### Response:

- __200__ (Ok)

```json
{
  "message": "The server creation process has been started.",
  "server": {
    "id": 14,
    "organization_id": 5,
    "provider_name": "lightsail",
    "ip": "53.21.17.517",
    "name": "alex-sites",
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
  }
}
```

#### Server Name Exists
- __500__ (Internal Server Error)

```json
{
    "message": "Server instance name already exists!"
}
```

#### Provider Not Found
- __404__ (Not Found)

```json
{
    "message": "Server Provider not found!"
}
```

#### Forbidden
- __403__ (Forbidden)

```json
{
    "message": "You can not perform this action!"
}
```

#### Credit Error
- __500__ (Internal Server Error)

```json
{
    "message": "Not enough credits. Please add credits!"
}
```

#### Provider OS Version Error
- __500__ (Internal Server Error)

```json
{
    "message": "We support Ubuntu 20.04, 22.04 and 24.04 in {Provider Name}."
}
```

#### Allowed Servers
- __500__ (Internal Server Error)

```json
{
    "message": "You cannot add more than {Your Subscription Allowed Servers} servers in this account. Please upgrade or contact support."
}
```

#### Free  Server limit
- __500__ (Internal Server Error)

```json
{
    "message": "You cannot add more than 1 free servers in this account."
}
```

#### Server Error
- __500__ (Internal Server Error)
```json
{
    "message": "Something went really wrong!"
}