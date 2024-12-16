package repository

import (
	"gorm.io/gorm"

	"akutansi-web-api/model"
)

/*
| -----------------------------------------------------------------
| PREPARATIONS
| -----------------------------------------------------------------
*/

type userRepository struct {
	db *gorm.DB
}

func NewUserRepository(db *gorm.DB) UserRepository {
	return &userRepository{db}
}

/*
| -----------------------------------------------------------------
| FUNCTIONS
| -----------------------------------------------------------------
*/

func (r *userRepository) FindAllUserPublic() ([]*model.UserPublic, error) {
	var users []*model.UserPublic

	err := r.db.Model(model.User{}).Find(&users).Error

	return users, err
}
