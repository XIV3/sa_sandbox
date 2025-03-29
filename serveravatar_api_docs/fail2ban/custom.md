# Custom Jail For Application

Create or Update Custom Fail2ban for Application.

### HTTP Request:

```js
POST https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/fail2ban/
```

### Curl Request example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/5/servers/15/applications/92/fail2ban" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
  --data '{
      "jail_config_content": "enabled = true

                              # Caution: Please refrain from modifying this line as it could potentially lead to server instability.
                              filter = testfail

                              logpath = /home/ldvc7WUkESHufGCt/testfail/logs/access*log
                              maxretry = 3
                              bantime = 3600
                              findtime = 600
                              port = http.https",
      "filter_config_content": "failregex = ^<HOST> .* "POST .*wp-login.php
                                            ^<HOST> .* "POST .*xmlrpc.php"
    }'
```

### Response:

#### Fail2ban Custom Create/Update:

- __200__ (Ok)

```json
{
    "testOk" => true,
    "message" => "Fail2ban created successfully!"
}
```
#### Configuration Test Failed:
- __500__ (Internal Server Error)
```json
{
    "testOk": false,
    "message": "Custom Jail Configuration Test Failed!",
    "output": "2023-07-17 12:18:47,195 fail2ban                [126429]: ERROR   Failed during configuration: Source contains parsing errors: &#039;\/etc\/fail2ban\/jail.d\/testfail.conf&#039;\n\t[line 13]: &#039;dadadaw\\n&#039;\n2023-07-17 12:18:47,195 fail2ban                [126429]: ERROR   ERROR: test configuration failed\n"
}
```

#### Server Error
- __500__ (Internal Server Error)
```json
{
    "message": "Something went really wrong while custom creating fail2ban."
}
```
