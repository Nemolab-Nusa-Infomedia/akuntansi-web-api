package app

import (
	"fmt"
	"log"
	"os"

	"gorm.io/driver/mysql"
	"gorm.io/gorm"
	"gorm.io/gorm/logger"

	"akutansi-web-api/model/domain"
)

func ConnectDB() (*gorm.DB, error) {
	dsn := os.Getenv("DB_URL")

	db, err := gorm.Open(mysql.Open(dsn), &gorm.Config{
		Logger: logger.Default.LogMode(logger.Info),
	})

	if err != nil {
		return nil, fmt.Errorf("failed to connect to the database: %v", err)
	}

	log.Println("Running migrations")

	if err := db.AutoMigrate(
		&domain.Company{},
		&domain.User{},
		&domain.UserCompany{},
	); err != nil {
		return nil, err
	}

	return db, err
}
