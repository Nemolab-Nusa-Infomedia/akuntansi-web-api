package repository

import (
	"manajemen_tugas_master/model/domain"

	"gorm.io/gorm"
)

type userRepository struct {
	db *gorm.DB
}

func NewUserRepository(db *gorm.DB) UserRepository {
	return &userRepository{db}
}

func (r *userRepository) Signup(user *domain.User) error {

	return nil
}

func (r *userRepository) Login(user *domain.User) (*domain.User, error) {

	return nil, nil
}
