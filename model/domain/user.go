package domain

type UserPublic struct {
	ID
	TIMES

	Name  string `json:"name" gorm:"size:100; not null"`
	Email string `json:"email" gorm:"size:100; not null"`
	Phone string `json:"phone" gorm:"size:100; not null"`
}

type UserPrivate struct {
	StatusAccount string `json:"status_account" gorm:"type:enum('active','disable'); not null"`
	Password      string `json:"password" gorm:"size:100; not null"`
}

type User struct {
	UserPublic
	UserPrivate
}
