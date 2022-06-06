<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateGeneralSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.app_active', true);

        $this->migrator->add('general.ability_to_create_accounts', true);
        $this->migrator->add('general.ability_to_login', true);
        $this->migrator->add('general.ability_to_order', true);

        $this->migrator->add('general.site_name', 'Arkan');
        $this->migrator->add('general.store_title', 'Arkan Store');
        $this->migrator->add('general.store_description', 'High Quality at cheap price');
        $this->migrator->add('general.store_thumbnail', 'https://images.unsplash.com/photo-1445205170230-053b83016050?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mjd8fGNsb3RoZXN8ZW58MHx8MHx8&auto=format&fit=crop&w=500&q=60');
        $this->migrator->add('general.store_phone_number', '0910000000');
        $this->migrator->add('general.store_email', 'arkan@gmail.com');
    }
}
