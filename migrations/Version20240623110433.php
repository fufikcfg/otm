<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use function Symfony\Component\DependencyInjection\Loader\Configurator\env;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240623110433 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Initial migration';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE users (
        id BIGINT, 
        middle_name VARCHAR(20) NOT NULL, 
        given_name VARCHAR(20) NOT NULL, 
        family_name VARCHAR(20) NOT NULL, 
        username VARCHAR(20) NOT NULL, 
        email VARCHAR(255) NOT NULL, 
        password VARCHAR(255) NOT NULL, 
        created_at TIMESTAMP NOT NULL, 
        updated_at TIMESTAMP NOT NULL, 
        PRIMARY KEY(id)
        )');

        $this->addSql('CREATE TABLE roles (
        id BIGINT, 
        name VARCHAR(255) NOT NULL, 
        PRIMARY KEY(id)
        )');

        $this->addSql('CREATE TABLE user_roles (
        id BIGINT, 
        user_id INT NOT NULL, 
        role_id INT NOT NULL, 
        created_at TIMESTAMP NOT NULL, 
        updated_at TIMESTAMP NOT NULL, 
        PRIMARY KEY(id),
        FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE,
        FOREIGN KEY (role_id) REFERENCES roles (id) ON DELETE CASCADE
        )');

        $this->addSql('CREATE TABLE projects (
        id BIGINT, 
        name VARCHAR(255) NOT NULL, 
        description TEXT NOT NULL, 
        owner_id INT NOT NULL,
        PRIMARY KEY(id),
        FOREIGN KEY (owner_id) REFERENCES users (id) ON DELETE CASCADE
        )');

        $this->addSql('CREATE TABLE user_projects (
        id BIGINT, 
        project_id INT NOT NULL, 
        user_id INT NOT NULL, 
        PRIMARY KEY(id),
        FOREIGN KEY (project_id) REFERENCES projects (id) ON DELETE CASCADE,
        FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
        )');

        $this->addSql('CREATE TABLE task_statuses (
        id BIGINT, 
        name VARCHAR(255) NOT NULL, 
        color VARCHAR(255) NOT NULL, 
        PRIMARY KEY(id)
        )');

        $this->addSql('CREATE TABLE task_priorities (
        id BIGINT, 
        name VARCHAR(255) NOT NULL, 
        color VARCHAR(255) NOT NULL, 
        PRIMARY KEY(id)
        )');

        $this->addSql('CREATE TABLE tasks (
        id BIGINT, 
        title VARCHAR(255) NOT NULL, 
        status_id INT NOT NULL, 
        priority_id INT NOT NULL, 
        due_date TIMESTAMP NOT NULL, 
        project_id INT NOT NULL, 
        created_at TIMESTAMP NOT NULL, 
        updated_at TIMESTAMP NOT NULL, 
        PRIMARY KEY(id),
        FOREIGN KEY (status_id) REFERENCES task_statuses (id) ON DELETE CASCADE,
        FOREIGN KEY (priority_id) REFERENCES task_priorities (id) ON DELETE CASCADE,
        FOREIGN KEY (project_id) REFERENCES projects (id) ON DELETE CASCADE
        )');

        $this->addSql('CREATE TABLE task_comments (
        id BIGINT, 
        task_id INT NOT NULL, 
        user_id INT NOT NULL, 
        comment TEXT NOT NULL, 
        created_at TIMESTAMP NOT NULL, 
        updated_at TIMESTAMP NOT NULL, 
        PRIMARY KEY(id),
        FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE,
        FOREIGN KEY (task_id) REFERENCES tasks (id) ON DELETE CASCADE
        )');

        $this->addSql('CREATE TABLE actions (
        id BIGINT, 
        name VARCHAR(255) NOT NULL, 
        color VARCHAR(255) NOT NULL, 
        PRIMARY KEY(id)
        )');

        $this->addSql('CREATE TABLE task_logs (
        id BIGINT, 
        name VARCHAR(255) NOT NULL, 
        color VARCHAR(255) NOT NULL, 
        user_id INT NOT NULL, 
        task_id INT NOT NULL, 
        action_id INT NOT NULL, 
        PRIMARY KEY(id),
        FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE,
        FOREIGN KEY (task_id) REFERENCES tasks (id) ON DELETE CASCADE,
        FOREIGN KEY (action_id) REFERENCES actions (id) ON DELETE CASCADE
        )');

        $this->addSql('CREATE TABLE assigned_user_tasks (
        id BIGINT, 
        user_id INT NOT NULL, 
        task_id INT NOT NULL, 
        PRIMARY KEY(id),
        FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE,
        FOREIGN KEY (task_id) REFERENCES tasks (id) ON DELETE CASCADE
        )');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE "assigned_user_tasks"');
        $this->addSql('DROP TABLE "task_logs"');
        $this->addSql('DROP TABLE "actions"');
        $this->addSql('DROP TABLE "task_comments"');
        $this->addSql('DROP TABLE "tasks"');
        $this->addSql('DROP TABLE "task_priorities"');
        $this->addSql('DROP TABLE "task_statuses"');
        $this->addSql('DROP TABLE "user_projects"');
        $this->addSql('DROP TABLE "projects"');
        $this->addSql('DROP TABLE "user_roles"');
        $this->addSql('DROP TABLE "roles"');
        $this->addSql('DROP TABLE "users"');
    }
}
