package repository

import (
	"gorm.io/gorm"

	"akutansi-web-api/model/domain"
)

type userRepository struct {
	db *gorm.DB
}

func NewUserRepository(db *gorm.DB) UserRepository {
	return &userRepository{db}
}

func (r *userRepository) FindAll() ([]*domain.UserPublic, error) {
	var users []*domain.UserPublic

	err := r.db.Table("users").Select(
		"id",
		"created_at",
		"updated_at",

		"phone",
		"email",
		"name",
	).Find(&users).Error

	if err != nil {
		return nil, err
	}
	return users, nil
}
