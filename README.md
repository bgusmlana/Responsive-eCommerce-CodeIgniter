
# Responsive eCommerce CodeIgniter

A small responsive website developed using codeigniter framework


## Requirements

- PHP 7.2 or 7.3


## Installation

```sh
git clone https://github.com/bagusmaulana06/Responsive-eCommerce-CodeIgniter.git
```

## RajaOngkir API Key

Replace the RajaOngkir API Key in the Rajaongkir config file with your API Key.


## Email Settings (SMTP)

Change the Email Settings (SMTP) in the Email Helper file and the Admin Controller file with your email settings.


## Fix error GROUP BY

Change sql mode in MySQL with this command

```sql
SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));
```
