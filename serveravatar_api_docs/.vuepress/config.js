const { description } = require('../../package')

module.exports = {
  base:'/api-docs/',
  /**
   * Ref：https://v1.vuepress.vuejs.org/config/#title
   */
  title: 'ServerAvatar',
  /**
   * Ref：https://v1.vuepress.vuejs.org/config/#description
   */
  description: description,

  /**
   * Extra tags to be injected to the page HTML `<head>`
   *
   * ref：https://v1.vuepress.vuejs.org/config/#head
   */
  head: [
    ['meta', { name: 'theme-color', content: '#3eaf7c' }],
    ['meta', { name: 'apple-mobile-web-app-capable', content: 'yes' }],
    ['meta', { name: 'apple-mobile-web-app-status-bar-style', content: 'black' }],
    ['link', { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }],
    ['link', { rel: 'stylesheet', href: "https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap"}]
  ],

  /**
   * Theme configuration, here is the default theme configuration for VuePress.
   *
   * ref：https://v1.vuepress.vuejs.org/theme/default-theme-config.html
   */
  themeConfig: {
    search: true,
    logo:'/logo.png',
    footer: "ServerAvatar",
    smoothScroll: true,
    repo: '',
    editLinks: false,
    docsDir: '',
    editLinkText: '',
    lastUpdated: true,
    nav: [
      {
        text: 'Docs',
        link: 'https://serveravatar.com/docs'
      },
      {
        text: 'ServerAvatar',
        link: 'https://serveravatar.com'
      }
    ],
    sidebar:[
        {
          title: 'Introduction',
          collapsable: false,
          path: '/'
        },
        {
            title: 'Endpoints',
            collapsable: true,
            children: [
                {
                    title: 'Organization',
                    collapsable: true,
                    children: [
                        '/endpoint/organization/',
                        '/endpoint/organization/show',
                        '/endpoint/organization/member'
                    ]
                },
                {
                    title: 'Server Provider',
                    collapsable: true,
                    children: [
                        '/endpoint/server-provider/',
                        '/endpoint/server-provider/region',
                        '/endpoint/server-provider/size',
                    ]  
                },
                {
                    title: 'Git Provider',
                    collapsable: true,
                    children: [
                        '/endpoint/git-provider/',
                        '/endpoint/git-provider/delete'
                    ]  
                },

                {
                    title: 'Storage Provider',
                    collapsable: true,
                    children: [
                        '/endpoint/backup/backup-provider',
                    ]  
                },
                {
                    title: 'Server',
                    collapsable: true,
                    children: [
                        '/endpoint/server/',
                        '/endpoint/server/create',
                        '/endpoint/server/status',
                        '/endpoint/server/show',
                        '/endpoint/server/update',
                        '/endpoint/server/destroy',
                        '/endpoint/server/restart',
                        '/endpoint/server/resources-usage',
                        '/endpoint/server/summary',
                        '/endpoint/server/logs',
                        '/endpoint/server/services',
                        '/endpoint/server/alerts',
                        '/endpoint/server/default-page',
                        '/endpoint/server/disable-page',
                        '/endpoint/server/restart-schedule',
                        '/endpoint/server/change-root-password',
                        '/endpoint/server/tags'
                    ]
                },
                {
                    title: 'Firewall',
                    collapsable: true,
                    children: [
                        '/endpoint/firewall/',
                        '/endpoint/firewall/lists',
                        '/endpoint/firewall/create',
                        '/endpoint/firewall/destroy'
                    ]
                },
                {
                    title: 'Fail2ban',
                    collapsable: true,
                    children: [
                        '/endpoint/fail2ban/',
                        '/endpoint/fail2ban/show-ssh',
                        '/endpoint/fail2ban/ssh-update',
                        '/endpoint/fail2ban/custom',
                        '/endpoint/fail2ban/show-custom',
                        '/endpoint/fail2ban/custom-delete',
                        '/endpoint/fail2ban/ban-ignore-ips-list',
                        '/endpoint/fail2ban/create-ban-ip',
                        '/endpoint/fail2ban/unban-ip',
                        '/endpoint/fail2ban/create-ignore-ip',
                        '/endpoint/fail2ban/ignore-ip-delete'
                    ]
                },
                {
                    title: 'Cronjob',
                    collapsable: true,
                    children: [
                        '/endpoint/cronjob/',
                        '/endpoint/cronjob/presets',
                        '/endpoint/cronjob/create',
                        '/endpoint/cronjob/show',
                        '/endpoint/cronjob/update',
                        '/endpoint/cronjob/toggle',
                        '/endpoint/cronjob/destroy'
                    ]
                },
                {
                    title: 'Database',
                    collapsable: true,
                    children: [
                        '/endpoint/database/',
                        '/endpoint/database/create',
                        //'/endpoint/database/phpmyadmin',
                        '/endpoint/database/destroy'
                    ]
                },
                {
                    title: 'Database User',
                    collapsable: true,
                    children: [
                        '/endpoint/database-user/',
                        '/endpoint/database-user/create',
                        '/endpoint/database-user/update',
                        '/endpoint/database-user/destroy'
                    ]
                },
                {
                    title: 'Application User',
                    collapsable: true,
                    children: [
                        '/endpoint/application-user/',
                        '/endpoint/application-user/create',
                        '/endpoint/application-user/show',
                        '/endpoint/application-user/update',
                        '/endpoint/application-user/destroy',
                        '/endpoint/application-user/ssh-access',
                        '/endpoint/application-user/ssh-key-remove'
                    ]
                },
                {
                    title: 'Application',
                    collapsable: true,
                    children: [
                        '/endpoint/application/',
                        '/endpoint/application/create',
                        '/endpoint/application/show',
                        '/endpoint/application/destroy',
                        '/endpoint/application/add-database',
                        '/endpoint/application/remove-database',
                        '/endpoint/application/wp-login',
                        '/endpoint/application/logs',
                        '/endpoint/application/advance-log',
                        '/endpoint/application/php-settings',
                        '/endpoint/application/sftp-credentials',
                        '/endpoint/application/application-toggle',
                        '/endpoint/application/basic-authentication',
                        '/endpoint/application/tags'
                    ]
                },
                {
                    title: 'Application Domain',
                    collapsable: true,
                    children: [
                        '/endpoint/application-domain/',
                        '/endpoint/application-domain/create',
                        '/endpoint/application-domain/destroy',
                        '/endpoint/application-domain/primary_domain_change',
                        '/endpoint/application-domain/toggle'
                    ]
                },
                {
                    title: 'Git',
                    collapsable: true,
                    children: [
                        '/endpoint/git-deployment/ssh-key',
                        '/endpoint/git-deployment/repository',
                        '/endpoint/git-deployment/branch',
                        '/endpoint/git-deployment/checkout',
                        '/endpoint/git-deployment/pull',
                        '/endpoint/git-deployment/script',
                        '/endpoint/git-deployment/commit-record',
                        '/endpoint/git-deployment/log'
                    ]
                },
                {
                    title: 'Node',
                    collapsable: true,
                    children: [
                        '/endpoint/node/',
                        '/endpoint/node/update-nginx-conf',
                        '/endpoint/node/update-env-variable',
                        '/endpoint/node/update-command',
                        '/endpoint/node/update-ssr-port',
                        {
                            title: 'PM2',
                            collapsable: true,
                            children: [
                                '/endpoint/node/pm2/detail',
                                '/endpoint/node/pm2/log',
                            ]
                        },
                    ]
                },                
                {
                    title: 'Cloudflare Integration',
                    collapsable: true,
                    children: [
                        '/endpoint/cloudflare-integration/settings',
                        '/endpoint/cloudflare-integration/dns-records',
                        '/endpoint/cloudflare-integration/ssl',
                        '/endpoint/cloudflare-integration/edge-certi',
                        '/endpoint/cloudflare-integration/https-redirect',
                        '/endpoint/cloudflare-integration/https-rewrite',
                        '/endpoint/cloudflare-integration/tls-13',
                        '/endpoint/cloudflare-integration/tls-version'
                    ]
                },
                {
                    title: 'SSL',
                    collapsable: true,
                    children: [
                        '/endpoint/ssl/',
                        '/endpoint/ssl/show',
                        '/endpoint/ssl/update',
                        '/endpoint/ssl/force-https',
                        '/endpoint/ssl/stop-force-http',
                        '/endpoint/ssl/destroy'
                    ]
                },
                {
                    title: 'Backup',
                    collapsable: true,
                    children: [
                        '/endpoint/backup/',
                        '/endpoint/backup/preset',
                        '/endpoint/backup/create',
                        '/endpoint/backup/update',
                        '/endpoint/backup/download',
                        '/endpoint/backup/restore',
                        '/endpoint/backup/destroy',
                        '/endpoint/backup/archive-backup'
                    ]
                },
                {
                    title: 'File Manager ',
                    collapsable: true,
                    children: [
                        '/endpoint/file-manager/',
                        '/endpoint/file-manager/create',
                        '/endpoint/file-manager/rename',
                        '/endpoint/file-manager/get',
                        '/endpoint/file-manager/update',
                        '/endpoint/file-manager/move',
                        '/endpoint/file-manager/copy',
                        '/endpoint/file-manager/delete',
                        '/endpoint/file-manager/compress',
                        '/endpoint/file-manager/uncompress',
                        '/endpoint/file-manager/permission-update'
                    ]
                },
                {
                    title: 'Site Migration ',
                    collapsable: true,
                    children: [
                        '/endpoint/site-migration/',
                        '/endpoint/site-migration/create'
                    ]
                },
                {
                    title: 'Site Clone ',
                    collapsable: true,
                    children: [
                        '/endpoint/site-clone/',
                        '/endpoint/site-clone/create'
                    ]
                },
                {
                    title: 'Staging Area ',
                    collapsable: true,
                    children: [
                        '/endpoint/staging-area/',
                        '/endpoint/staging-area/create',
                        '/endpoint/staging-area/status',
                        '/endpoint/staging-area/sync',
                        '/endpoint/staging-area/delete'
                    ]
                },
                {
                    title: 'Disk Cleaner',
                    collapsable: true,
                    children: [
                        '/endpoint/disk-cleaner/',
                        '/endpoint/disk-cleaner/disk-clean'
                    ]
                },
                {
                    title: 'Supervisor',
                    collapsable: true,
                    children: [
                        '/endpoint/supervisor/',
                        '/endpoint/supervisor/create',
                        '/endpoint/supervisor/update',
                        '/endpoint/supervisor/show',
                        '/endpoint/supervisor/action',
                        '/endpoint/supervisor/delete'
                    ]
                },
                {
                    title: 'Whitelabel',
                    collapsable: true,
                    children: [
                        '/endpoint/whitelabel/',
                        '/endpoint/whitelabel/create',
                        '/endpoint/whitelabel/update',
                        '/endpoint/whitelabel/delete'
                    ]
                }
            ]
        }
    ]
  },

  /**
   * Apply plugins，ref：https://v1.vuepress.vuejs.org/zh/plugin/
   */
  plugins: [
    '@vuepress/plugin-back-to-top',
    '@vuepress/plugin-medium-zoom',
  ]
}
