/*INSERT INTO hoteluom.roles (name,guard_name,created_at,updated_at) VALUES
('Administrador','web','2019-08-21 16:52:42.000','2019-08-21 16:52:42.000')
;*/
INSERT INTO hoteluom.permissions (name,guard_name,created_at,updated_at) VALUES
('user.view','web','2019-08-21 16:52:38.000','2019-08-21 16:52:38.000')
,('user.create','web','2019-08-21 16:52:38.000','2019-08-21 16:52:38.000')
,('user.edit','web','2019-08-21 16:52:38.000','2019-08-21 16:52:38.000')
,('user.delete','web','2019-08-21 16:52:38.000','2019-08-21 16:52:38.000')
,('room_category.view','web','2019-08-21 16:52:38.000','2019-08-21 16:52:38.000')
,('room_category.create','web','2019-08-21 16:52:38.000','2019-08-21 16:52:38.000')
,('room_category.edit','web','2019-08-21 16:52:38.000','2019-08-21 16:52:38.000')
,('room_category.delete','web','2019-08-21 16:52:38.000','2019-08-21 16:52:38.000')
,('cleaning_status.view','web','2019-08-21 16:52:39.000','2019-08-21 16:52:39.000')
,('cleaning_status.create','web','2019-08-21 16:52:39.000','2019-08-21 16:52:39.000')
,('cleaning_status.edit','web','2019-08-21 16:52:39.000','2019-08-21 16:52:39.000')
,('cleaning_status.delete','web','2019-08-21 16:52:39.000','2019-08-21 16:52:39.000')
,('sos.view','web','2019-08-21 16:52:39.000','2019-08-21 16:52:39.000')
,('sos.create','web','2019-08-21 16:52:39.000','2019-08-21 16:52:39.000')
,('sos.edit','web','2019-08-21 16:52:39.000','2019-08-21 16:52:39.000')
,('sos.delete','web','2019-08-21 16:52:39.000','2019-08-21 16:52:39.000')
,('room.view','web','2019-08-21 16:52:39.000','2019-08-21 16:52:39.000')
,('room.create','web','2019-08-21 16:52:39.000','2019-08-21 16:52:39.000')
,('room.edit','web','2019-08-21 16:52:39.000','2019-08-21 16:52:39.000')
,('room.delete','web','2019-08-21 16:52:39.000','2019-08-21 16:52:39.000')
,('customer_type.view','web','2019-08-21 16:52:40.000','2019-08-21 16:52:40.000')
,('customer_type.create','web','2019-08-21 16:52:40.000','2019-08-21 16:52:40.000')
,('customer_type.edit','web','2019-08-21 16:52:40.000','2019-08-21 16:52:40.000')
,('customer_type.delete','web','2019-08-21 16:52:40.000','2019-08-21 16:52:40.000')
,('customer.view','web','2019-08-21 16:52:40.000','2019-08-21 16:52:40.000')
,('customer.create','web','2019-08-21 16:52:40.000','2019-08-21 16:52:40.000')
,('customer.edit','web','2019-08-21 16:52:40.000','2019-08-21 16:52:40.000')
,('customer.delete','web','2019-08-21 16:52:40.000','2019-08-21 16:52:40.000')
,('pos.view','web','2019-08-21 16:52:40.000','2019-08-21 16:52:40.000')
,('pos.create','web','2019-08-21 16:52:40.000','2019-08-21 16:52:40.000')
,('pos.edit','web','2019-08-21 16:52:40.000','2019-08-21 16:52:40.000')
,('pos.delete','web','2019-08-21 16:52:41.000','2019-08-21 16:52:41.000')
,('pos_opening.view','web','2019-08-21 16:52:41.000','2019-08-21 16:52:41.000')
,('pos_opening.create','web','2019-08-21 16:52:41.000','2019-08-21 16:52:41.000')
,('pos_opening.edit','web','2019-08-21 16:52:41.000','2019-08-21 16:52:41.000')
,('pos_opening.delete','web','2019-08-21 16:52:41.000','2019-08-21 16:52:41.000')
,('pos_movement.view','web','2019-08-21 16:52:41.000','2019-08-21 16:52:41.000')
,('pos_movement.create','web','2019-08-21 16:52:41.000','2019-08-21 16:52:41.000')
,('pos_movement.edit','web','2019-08-21 16:52:41.000','2019-08-21 16:52:41.000')
,('reservations.view','web','2019-08-21 16:52:41.000','2019-08-21 16:52:41.000')
,('reservations.create','web','2019-08-21 16:52:41.000','2019-08-21 16:52:41.000')
,('reservations.edit','web','2019-08-21 16:52:41.000','2019-08-21 16:52:41.000')
,('reservations.delete','web','2019-08-21 16:52:41.000','2019-08-21 16:52:41.000')
,('billingAccounts.view','web','2019-08-21 16:52:42.000','2019-08-21 16:52:42.000')
,('billingAccounts.create','web','2019-08-21 16:52:42.000','2019-08-21 16:52:42.000')
,('billingAccounts.edit','web','2019-08-21 16:52:42.000','2019-08-21 16:52:42.000')
,('billingAccounts.delete','web','2019-08-21 16:52:42.000','2019-08-21 16:52:42.000')
,('profiles.view','web','2019-08-21 16:52:42.000','2019-08-21 16:52:42.000')
,('profiles.create','web','2019-08-21 16:52:42.000','2019-08-21 16:52:42.000')
,('profiles.edit','web','2019-08-21 16:52:42.000','2019-08-21 16:52:42.000')
,('profiles.delete','web','2019-08-21 16:52:42.000','2019-08-21 16:52:42.000')
,('destroy_notes','web','2019-08-22 21:27:05.000','2019-08-22 21:27:05.000')
;

INSERT INTO hoteluom.model_has_roles (role_id,model_id,model_type) VALUES
(1,1,'App\\User')
,(1,2,'App\\User')
,(1,3,'App\\User')
;

INSERT INTO hoteluom.role_has_permissions (permission_id,role_id) VALUES
(1,1)
,(2,1)
,(3,1)
,(4,1)
,(5,1)
,(6,1)
,(7,1)
,(8,1)
,(9,1)
,(10,1)
,(11,1)
,(12,1)
,(13,1)
,(14,1)
,(15,1)
,(16,1)
,(17,1)
,(18,1)
,(19,1)
,(20,1)
,(21,1)
,(22,1)
,(23,1)
,(24,1)
,(25,1)
,(26,1)
,(27,1)
,(28,1)
,(29,1)
,(30,1)
,(31,1)
,(32,1)
,(33,1)
,(34,1)
,(35,1)
,(36,1)
,(37,1)
,(38,1)
,(39,1)
,(40,1)
,(41,1)
,(42,1)
,(43,1)
,(44,1)
,(45,1)
,(46,1)
,(47,1)
,(48,1)
,(49,1)
,(50,1)
,(51,1)
;